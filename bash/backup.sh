#!/bin/bash

#PATH/NAME for Backup
P="/mnt/backup/docker"
N="${HOSTNAME}_"$(date +"%Y%m%d-%H%M")
Y="${HOSTNAME}_"$(date --date="-1 day" +"%Y%m%d")
mkdir -p $P/db_hourly $P/db_daily $P/file_daily # create a test directory.

#DB Backup - hourly/daily
L="${P}/.db_running"
if [ ! -f $L ]; then # check for previous backup of db.
  touch $L
  echo '-------------------------'
  #create db for Yesterday/daily
  echo '> create db for Yesterday/daily'
  cd $P/db_daily
  if [ ! -f "${Y}_db1.tar.gz" ]; then # daily - Yesterday
    docker exec mongo1 /mongo_backup.sh $Y
    tar -cvzf "${Y}_db1.tar.gz" -C /var/lib/mongo/backup1 $Y
    rm -rf /var/lib/mongo/backup1/$Y
  fi
  if [ ! -f "${Y}_db2.tar.gz" ]; then
    docker exec mongo2 /mongo_backup.sh $Y
    tar -cvzf "${Y}_db2.tar.gz" -C /var/lib/mongo/backup2 $Y
    rm -rf /var/lib/mongo/backup2/$Y
  fi
  echo '-------------------------'
  echo '> delete db from more than 7 days/hourly'
  cd $P/db_hourly
  M="${HOSTNAME}_"$(date --date="-7 days" +"%Y%m%d")"-0000_db0.tar.gz"
  for file in "${HOSTNAME}_"*"_db"*".tar.gz"; do
    if [[ -f $file ]]; then
      FN="${file##*/}"
      if [ "$M" ">" "$FN" ]; then
        echo "${M} > ${FN} - more than 7 days - hourly / deleting"
        rm -rf $file
      fi
    fi
  done

  echo '-------------------------'
  echo '> create db for Today/hourly'
  cd $P/db_hourly
  docker exec mongo1 /mongo_backup.sh $N
  tar -cvzf "${N}_db1.tar.gz" -C /var/lib/mongo/backup1 $N
  rm -rf /var/lib/mongo/backup1/$N
  docker exec mongo2 /mongo_backup.sh $N
  tar -cvzf "${N}_db2.tar.gz" -C /var/lib/mongo/backup2 $N
  rm -rf /var/lib/mongo/backup2/$N

  echo '-------------------------'
  echo '> delete db from 1 month/daily'
  cd $P/db_daily
  M="${HOSTNAME}_"$(date --date="-1 month" +"%Y%m%d")"_db0.tar.gz"
  for file in "${HOSTNAME}_"*"_db"*".tar.gz"; do
    if [[ -f $file ]]; then
      FN="${file##*/}"
      if [ "$M" ">" "$FN" ]; then
        echo "${M} > ${FN} - more than 1 month - daily / deleting"
        rm -rf $file
      fi
    fi
  done
  rm -rf $L
elif [ $(($(date +%s)-$(stat -c %Y "$L"))) -gt 3600 ]; then
  rm -rf $L
fi
echo '-------------------------'
L="${P}/.file_running"
if [ ! -f $L ]; then
  touch $L
  cd $P/file_daily
  echo '> copy files - update only'
  cp -uavr /var/www/jarm.com/files/upload $P # copy to temp (update only)
  echo '-------------------------'
  echo '> create Yesterday files'
  if [ ! -f "${Y}_file.tar.gz" ]; then
    tar -cvzf "${Y}_file.tar.gz" -C $P --remove-files upload # compress & del for new day
  fi
  echo '-------------------------'
  echo '> delete file from 1 month/daily'
  M="${HOSTNAME}_"$(date --date="-1 month" +"%Y%m%d")"_file.tar.gz"
  for file in "${HOSTNAME}_"*"_file.tar.gz"; do
    if [[ -f $file ]]; then
      FN="${file##*/}"
      if [ "$M" ">" "$FN" ]; then
        echo "${M} > ${FN} - more than 1 month - daily / deleting"
        rm -rf $file
      fi
    fi
  done
  echo '-------------------------'
  rm -rf $L
elif [ $(($(date +%s)-$(stat -c %Y "$L"))) -gt $((6*3600)) ]; then
  rm -rf $L
fi
