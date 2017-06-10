#!/bin/bash
gvar=0
FILES=/var/www/jarm.com/files/cdn
#FILES=../files/cdn
makegz(){
    for f in $(ls $FILES$1)
    do
        if [ -d $FILES$1$f ]
        then
           makegz $1$f/
        else
           if [ "${f##*.}" == "css" ] || [ "${f##*.}" == "js" ]
           then
         gvar=$((gvar+1))
               echo $((gvar)). creating: $1$f.gz
               gzip -cf9 $FILES$1$f > $FILES$1$f.gz
            fi
        fi
    done
}
cleangz(){
    for f in $(ls $FILES$1)
    do
        if [ -d $FILES$1$f ]
        then
           cleangz $1$f/
        else
           if [ "${f##*.}" == "gz" ] || [ "$f" == ".DS_Store" ]
           then
         gvar=$((gvar+1))
               echo $((gvar)). deleting: $1$f
               rm -f $FILES$1$f
            fi
        fi
    done
}
genfiles(){
    echo createing js/jarm-all.js
    cat $FILES/lib/jquery/jquery.min.js > $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    cat $FILES/lib/bootstrap/js/bootstrap.min.js >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    cat $FILES/js/lazyload/jquery.lazyload.min.js >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    echo  >> $FILES/js/jarm-all.js
    cat $FILES/js/jarm.js >> $FILES/js/jarm-all.js

    echo createing css/jarm-all.css
    sed "s/\.\.\/fonts/\.\.\/lib\/bootstrap\/fonts/g" $FILES/lib/bootstrap/css/bootstrap.min.css > $FILES/css/jarm-all.css
    #cat $FILES/js/bootstrap/css/bootstrap.min.css > $FILES/css/jarm-all.css
    echo  >> $FILES/css/jarm-all.css
    echo  >> $FILES/css/jarm-all.css
    echo  >> $FILES/css/jarm-all.css
    cat $FILES/css/jarm-bootstrap.css >> $FILES/css/jarm-all.css
}

case $1 in
    make)
        makegz /
        echo Create: $gvar files
    ;;
    clean)
        cleangz /
        echo Remove: $gvar files
    ;;
    genfile)
        genfiles
    ;;
    all)
        genfiles
        sleep 3
        cleangz /
        echo Remove: $gvar files
        gvar=0
        sleep 3
        makegz /
        echo Create: $gvar files
    ;;
    *)
        echo Usage: gzip.sh {make\|clean\|genfile\|all}
esac
