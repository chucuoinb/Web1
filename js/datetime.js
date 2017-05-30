/**
 * Created by MToan on 4/4/2017.
 */
$(function () {
    setInterval(update, 1000);
    function datetime() {
        var curtime = new Date().toLocaleString();
        var day = ["Mon","Tue","Wed","Thu","Fri","Sat","Sun"]
        var curDay = (new Date).getDay();
        return day[curDay] + ", " + curtime
    }
    function update() {
        $("#date").text(datetime());
    }
    function formatDate(val) {
        if (val < 10)
            return "0" + val;
    }
})
