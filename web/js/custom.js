function showForm(block){
    $('#disabled_page').fadeIn(500);
    element = document.getElementById(block);
    $('#'+block).show(500);
}
function hideForm(block){
    $('#disabled_page').fadeIn(500);
    $('#'+block).hide(500);
    $('#disabled_page').hide(500);
  
}
function modal(eid, evl, elid, eshw)  {
    document.getElementById(eid).value=evl;
    document.getElementById(eid+'id').value=elid;
    showForm(eshw);
}
function ViewBookModal(bookid)  {
  $.ajax({  
    type: "POST",
    data:  {bid: bookid},
    url: "ajaxdata/ViewBookModal.php",
    dataType: "html", 
    cache: false,  
    success: function(msg){ $("#view_desc").html(msg); }  
  }); 
  showForm('desc');
}

function SaveSearch() {
  var el1 = document.getElementById('search_author').value;
  var el2 = document.getElementById('search_name').value;
  var el3 = document.getElementById('datetimepicker1').value;
  var el4 = document.getElementById('datetimepicker2').value;

  document.cookie = "searchAuthor="+el1+"; path=/;";
  document.cookie = "searchName="+el2+"; path=/;";
  document.cookie = "searchFrom="+el3+"; path=/;";
  document.cookie = "searchTo="+el4+"; path=/;";
  document.location.reload(true);
}

function getSavedSearch() {
  var el1 = getCookie("searchAuthor");
  var el2 = getCookie("searchName");
  var el3 = getCookie("searchFrom");
  var el4 = getCookie("searchTo");

  if (!!el1)  document.getElementById('search_author').value   = el1; 
  if (!!el2)  document.getElementById('search_name').value     = el2; 
  if (!!el3)  document.getElementById('datetimepicker1').value = el3;
  if (!!el4)  document.getElementById('datetimepicker2').value = el4;

}

function getCookie(name) {
  var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}