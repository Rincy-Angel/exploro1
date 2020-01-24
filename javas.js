var ajaxRequest;
var jsonObj;
var uname = ''; //LOGGEDIN USER

function showLogin() {

  $('#mainBody').load('loginpage.html');

}

//CHECKING LOGIN
function loginValid() {
  uname = $('#lUname').val();
  var pass = $('#lPassword').val();

  console.log('in',uname, pass);

  $.getJSON('articles.JSON', function(data) {
    try{
      if(data[uname].pass == pass){
        showInfo();
      } else {
        $('#lwarn').html("Invalid Username/Password");
      }
    } catch (e) {
      $('#lwarn').html("Invalid Username/Password");
    }
  });
}

//LOGOUT
function logoutFunc(){
  uname = '';

  //HEADER
  $('#subtext').html('');

  showLogin();
}

//REGISTRATION PROCESSING
function registerValid() {
  uname = $('#rUname').val();
  var email = $('#rEmail').val();
  var pass = $('#rPassword').val();

  console.log(uname, email, pass);

  $.getJSON('articles.JSON', function(data) {
    //ADDING USER
    var addData = {[uname]: {"email": email, "pass": pass}};
    $.extend(true, data, addData);

    console.log(addData, data);

    //SAVING EDITED DATA
    var newData = JSON.stringify(data);
    jQuery.post('regUsers.php', {
        newData: newData
    }, function(response){
        $('#rwarn').html("Registration Successfull");
        $('#rUname').val('');
        $('#rEmail').val('');
        $('#rPassword').val('');
    });
  });
}

//POLL FEED
function pollFeed() {
  $.getJSON('voterList.JSON', function(data) {
    //CLEAR POLL FEED
    $('#pollScroll').html('');

    //POPULATE FEED
    for(var i in data){
      console.log(data[i].voter + ' voted for ' + data[i].votee);
      $('#pollScroll').append(data[i].voter + ' voted for ' + data[i].votee + '<br>');
    }
  });
}

//VOTE PROCESSING
function submitVote() {
  var chosenOp = $('input[name=poll]:checked').val();

  $.getJSON('articles.JSON', function(data) {
    //ADDING VOTE
    data[chosenOp].count += 1;
    data[chosenOp].voters.push(uname);
    console.log(data[chosenOp].count, data[chosenOp].voters);

    //SAVING EDITED DATA
    var newData = JSON.stringify(data);
    jQuery.post('one.php', {
        newData: newData
    }, function(response){
        'articles.JSON';
    })

  });
}

function fetchContent(eid) {
  try {
    ajaxRequest = new XMLHttpRequest();
    ajaxRequest.addEventListener('readystatechange', function () { stateChange(eid); }, false);
    ajaxRequest.open('GET', 'articles.JSON', true);
    ajaxRequest.send();
  } catch (e) {
    alert('Request failed');
  }
}

function stateChange(eid) {
  if(ajaxRequest.readyState == 4 && ajaxRequest.status == 200) {
    //JSON object
    jsonObj = JSON.parse(ajaxRequest.responseText);

    for (var i in jsonObj) {
      if (i == eid) {
        console.log(i, jsonObj[i].name, jsonObj[i].count);
        document.getElementById('joinfo').innerHTML = '<h3>' + jsonObj[i].name + '</h3>' + '<button class="btn btn-success" onclick="submitVote()">Submit Vote</button>' + jsonObj[i].desc;
        $('#_' + eid).prop('checked', true);
      }
    }
  }
}

function showJoInfo() {
  //HEADER
  $('#subtext').html('Welcome, <b>' + uname + '</b>!'+ ' <button class="btn btn-primary" onclick="logoutFunc()">Logout</button>');

  //POPULATE
  $('#mainBody').load('assets/voteMain.html');

  //SHOW SUB POLL
  pollFeed();

  //DOM ELEMENTS
  $(document).on('click', '#j1', function(event) { fetchContent('j1'); });
  $(document).on('click', '#j2', function(event) { fetchContent('j2'); });
  $(document).on('click', '#j3', function(event) { fetchContent('j3'); });
  $(document).on('click', '#j4', function(event) { fetchContent('j4'); });
  $(document).on('click', '#j5', function(event) { fetchContent('j5'); });
  $(document).on('click', '#j6', function(event) { fetchContent('j6'); });
  $(document).on('click', '#j7', function(event) { fetchContent('j7'); });
  $(document).on('click', '#j8', function(event) { fetchContent('j8'); });
}

window.onload = function() {
  if(uname == ''){
    showLogin();
  } else {
    showJoInfo();
  }

}
