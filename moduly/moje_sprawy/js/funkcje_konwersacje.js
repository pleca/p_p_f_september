var loading = function(element){
  element.append('<div class="loading"></div>');
};

var getConversationDetails = function(conversationId){
  $.ajax({
    type: "POST",
    url: API_URL + 'conversation/getdetails',
    data: {conversationId: conversationId},
    success: function (result) {
      $('.addQuestion').attr('disabled', 'true');
      $('.addQuestion').css('cursor', 'wait');


      $('.conversationsWindow').empty();
      for (var i = 0; i < result.length; i++) {
        if (result[i].side == 1) {
          var d = new Date();
          d = result[i].date;
          d = d.split("T");
          d[0] = d[0].replace(/-/g,".");
          $('.conversationsWindow').append('<li class="conversationMsg questionMsg"><div class="msgDiv"><span class="date questionDate">' + d[0] + '</span><p>' + result[i].content + '</p><span class="questionUser conversationUser">Ja</span></div></li>');
        } else {
          $('.conversationsWindow').append('<li class="conversationMsg answerMsg"><div class="msgDiv"><span class="date answerDate">' + d[0] + '</span><p>' + result[i].content + '</p><span class="answerUser conversationUser">Votum S.A.</span></div></li>');
        }
      }
      $('.loading').remove();
      $('.addQuestion').removeAttr('disabled');
      $('.addQuestion').css('cursor', 'context-menu');
      $('.conversationsWindow').scrollTop($('.conversationsWindow')[0].scrollHeight);
      $('#conversationMsg').val('');
      if($('.conversationsWindow li:last-child').hasClass('questionMsg')) {
        $('.conversationsWindow li:last-child').addClass('last-conversation-message');
      }
    }
  });

};

var testFunction = function(){
  getConversations();
  $('.conversationsList li:last-child').trigger("click");
};
var openConversation = function(result, id){
  $('.conversationsWindow').empty();
  $('.conversationTitle').empty();
  loading($('.conversationsWindow'));
  for(var j = 0 ; j < result.length ; j++){
    if(result[j]['id'] == id)
      var obj = result[j];
  }
  $('.conversationTitle').append(obj['subject']);
  $('.conversationsWindow').attr("id", id);

  getConversationDetails(id);
  var list = $(".conversationsList");
  var items = list[0].children;

  for (var i = 0; i < items.length; i++) {
    if(id != items[i].id) {
      items[i].className = "element-header";
      items[i].children[0].className = " ";
    }else{
      items[i].className = "element-header votum-red white";
      items[i].children[0].className = "white";
    }
  }
};
var getConversations = function(){
  loading($('.conversationsWindow'));
  $('.conversationsList').empty();
  $.ajax({
    type: "POST",
    url: API_URL + 'conversation/get',
    success: function(result) {
      for (var i = 0; i < result.length; i++) {
        $('.conversationsList').append('<li id="' + result[i]['id'] + '" class=" element-header"><span>' + result[i]['subject'] + '</span></li>');
        $('#' + result[i]['id']).on('click', function () {
          if($(this).hasClass('votum-red')){
            $('.conversation-body').addClass('hide');
            $('.conversation > .element-header').removeClass('votum-red');
            $('.conversation > .element-header > span').removeClass('white');
            $(this).removeClass('votum-red');
            $(this).find("span").removeClass('white');
            $('.conversationTitle').text('Konwersacja');
          }else{
            $('.conversation-body').removeClass('hide');
            $('.conversation > .element-header').addClass('votum-red');
            $('.conversation > .element-header > span').addClass('white');
            var url = $(this).data('url');
            var conversationId = location.search;
            var conversationId = conversationId.substr(conversationId.indexOf('=')+1, conversationId.length);
            if(conversationId != '') {
              openConversation(result, conversationId);
            }else {
              openConversation(result, this.id);
            }
          }
        });
      }
      $('.conversationsList li:last-child').trigger("click");
    }
  });
};

var addConversation = function(data){
  var conversationsJson = JSON.stringify(data);
  $.ajax({
    type: "POST",
    url: API_URL + 'conversation/addconversation',
    data: {conversation: conversationsJson},
    success: function(result) {
      window.console.log(result);
      $('.loading').remove();
      $('#conversationTitle').val('');
      $('#questionMsg').val('');
      getConversations();
    }
  });
};

var addMessage = function(data){
  var conversationJson = JSON.stringify(data);
  $.ajax({
    type: "POST",
    url: API_URL + 'conversation/addmessage',
    data: {conversation: conversationJson},
    success: function(result) {
      window.console.log(result);
      getConversationDetails(data.conversationId);
    }
  });
};

function onTargetSelect(e){
  if(e.dataItem.id == 2){
    $('#conversationCaseNumber').removeClass('hide');
    $('#conversationTitle').addClass('hide');
  }else{
    if(!$('#conversationCaseNumber').hasClass('hide')){
      $('#conversationCaseNumber').addClass('hide');
    }
    if($('#conversationTitle').hasClass('hide')){
      $('#conversationTitle').removeClass('hide');
    }
  }
}

$(document).on('ready', function(){
  //$('.sms_input').hide();
  $("#conversationTarget").kendoDropDownList({
    dataTextField: "target",
    dataValueField: "id",
    select: onTargetSelect,
    dataSource: {
      transport: {
        read: {
          dataType: "json",
          url: API_URL + "conversation/getconversationtarget",
        }
      }
    }
  });

  var conversations = new Array;
  getConversations();

  $('.appendConversation').on('click', function(){
    conversations = [];
    var data = {};
    if(((!$('#conversationTitle').hasClass('hide')) && ($('#conversationTitle').val() == ''))||($('#questionMsg').val() == '') || ((!$('#conversationCaseNumber').hasClass('hide')) && ($('#conversationCaseNumber').val() == ''))){
      $('#formError').append('<span class="formError"> Wypełnij poprawnie wszystkie pola!</span>');
      setTimeout(function() {
        $('#formError').empty();
      }, 1500);
    }else {
      // if((!$('#conversationCaseNumber').hasClass('hide')) && ($('#conversationCaseNumber').val() != '')){
      //   var conversationCaseNumber = $('#conversationCaseNumber').val();
      //   data.caseNumber = conversationCaseNumber;
      // }
      var conversationType = $('#conversationTarget').val();
      var conversationMsg = $('#questionMsg').val();
      if($('#conversationTitle').val()) {
        var conversationTitle = $('#conversationTitle').val();
      }else{
        var conversationTitle = $('#conversationCaseNumber').val();
      }
      var agentNumber = $('#agentNumber').val();
      data.agentNumber = agentNumber;
      data.type = conversationType;
      data.subject = conversationTitle;
      data.message = new Array;
      var messageData = {};
      messageData.content = conversationMsg;
      conversations.push(data);
      conversations[0].message = new Array;
      conversations[0].message.push(messageData);
      $('.conversationsList').empty();
      addConversation(conversations);
      $('.new-conversation-form').toggleClass('hide');
      $('.new-conversation-form-button > .fa').toggleClass('fa-chevron-right');
      $('.new-conversation-form-button > .fa').toggleClass('fa-chevron-down');
    }
  });


  $('.addQuestion').on('click', function(){
    if(($('#conversationMsg').val() == '')){
      $('#conversationError').append('<span class="formError"> Wypełnij pole wiadomości!</span>');
      setTimeout(function() {
        $('#conversationError').empty();
      }, 1500);

    }else {
      var data = {};
      data.content = $('#conversationMsg').val();
      data.conversationId = $('.conversationsWindow').attr('id');
      var message = new Array();
      message.push(data);
      addMessage(message[0]);

    }
  });
  $('.new-conversation-form-button').on('click', function(){
    $('.new-conversation-form').toggleClass('hide');
    $('.new-conversation-form-button > .fa').toggleClass('fa-chevron-right');
    $('.new-conversation-form-button > .fa').toggleClass('fa-chevron-down');
    // $('.new-conversation-form-button > span').addClass('white');
  });



});