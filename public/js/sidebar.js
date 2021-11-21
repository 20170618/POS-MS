$(document).ready(function () {

    var date = new Date();
    var month = date.toLocaleString('default', { month: 'long' });
    var newdate= (month) + ' ' + date.getDate() + ', ' +  date.getFullYear();

document.getElementById("demo").innerHTML = newdate;
});

