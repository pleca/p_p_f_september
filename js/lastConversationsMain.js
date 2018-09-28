var openConversation = function(result, id){
  location.href = '/moduly/moje_sprawy/konwersacje'+'?id='+id;
};
var getConversations = function(){
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
var getLastMessagesMain = function(){
  $('.lastMessagesMain').empty();
  var agentNumber = $('#agentNumber').val()

  $.ajax({
    type: "POST",
    url: API_URL + 'conversation/getlastconversation',
    async: false,
    data: {
      agentNumber: agentNumber
    },
    success: function(result) {
      for (var i = 0; i < result.length; i++) {
        $('.lastMessagesMain').append('<li id="' + result[i]['id'] + '" class="element-header votum-red"><p><span>'+ result[i]['subject'] +'</span><span style="float: right">'+ result[i]['date']+'</span></p><span>" ' + result[i]['content'] + ' "</span></li>');
        $('#' + result[i]['id']).on('click', function () {
            $('.conversation-body').addClass('hide');
            $('.conversation > .element-header').removeClass('votum-red');
            $('.conversation > .element-header > span').removeClass('white');
            $(this).find("span").removeClass('white');
            $('.conversationTitle').text('Konwersacja');
            openConversation(result, this.id);
            getConversations();
        });
      }
      $('.conversationsList li:last-child').trigger("click");
    }
  });
};

$(document).on('ready', function() {
  getLastMessagesMain();
});