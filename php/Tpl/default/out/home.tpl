<script>
var Base64 = {
	// private property
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	// public method for decoding
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;

		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {

			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));

			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;

			output = output + String.fromCharCode(chr1);

			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}

		}

		output = Base64._utf8_decode(output);

		return output;

	},
	// private method for UTF-8 decoding
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while ( i < utftext.length ) {

			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}

		}

		return string;
	}
}

var intd,cd=0;
$(function(){intd=setInterval(function(){reducintd()},300);});
function reducintd()
{
	if(cd<100)
	{
		cd++;
		$('#countd').html(cd);
		$('#appendd').css('width',cd+'%');
	}
	else
	{
		clearInterval(intd);
		var hash = window.location.hash;
		if(hash.length>1)
		{
			var h=$.trim(Base64.decode(hash.substr(1)));
			if(h)
			{
				window.location.href=h;
				return;
			}
		}
		$('#appendd').html('เกิดข้อผิดพลาด ลิ้งค์ปลายทางไม่ถูกต้อง...');
	}
}
</script>
<div style="margin:20px;border:5px solid #f5f5f5; border-radius:10px; padding:10px; ">
    <h2 class="bar-heading">ลิ้งค์ไปยังเว็บภายนอก</h2>
    <div style="padding:10px; font-size:13px; line-height:2em">
        กรุณารอซักครู่...<br>ระบบจะทำการนำท่านยังไปเว็บปลายทาง.
    </div>
    <div class="progress">
      <div id="appendd" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;-webkit-transition: width 1s;transition: width 1s;">
        <span><span id="countd"></span>%</span>
      </div>
    </div>
</div>
