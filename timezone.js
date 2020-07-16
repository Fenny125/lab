$(document).ready(function(){
	/*returns the number of minutes aheador behind green wich meridian*/
	var offset = new Date().getTimeZoneOffset();
	/*return the number of milliseconds since 1970/01/01:*/
	var timestamp = new Date().getTime();
	
	/*we convert our time to :universal time coordinated/universal coordinated time*/
	var utc_timestamp = timestamp +(60000 * offset);
	
    $("#submit").click(function (event) {
        $('#utc_timestamp').val(utc_timestamp);
        $('#time_zone_offset').val(offset)
    });

});
