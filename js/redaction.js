/*РЕДАКТОР ЗАМЕТОК*/


function insertTextZ( id, text, text2 ) {
  //ищем элемент по id
  var txtarea = document.getElementById(id);
  //ищем первое положение выделенного символа
  var start = txtarea.selectionStart;

  //ищем последнее положение выделенного символа
  var end = txtarea.selectionEnd;
  // текст до + вставка + текст после (если этот код не работает, значит у вас несколько id)
  var finText = txtarea.value.substring(0, start) + text + txtarea.value.substring(start, end) + text2 + txtarea.value.substring(end);
  //var finText = txtarea.value.substring(0, start) + text + txtarea.value.substring(end);
  // подмена значения
  txtarea.value = finText;
  // возвращаем фокус на элемент
  txtarea.focus();
  // возвращаем курсор на место - учитываем выделили ли текст или просто курсор поставили
  //txtarea.selectionEnd = ( start == end )? (end + text.length) : end ;
}


$(document).on('click', '.comInt', function (event) {
  insertTextZ('comLine', " = 'INT()';", "");
}); 


$(document).on('click', '.comFloat', function (event) {
  insertTextZ('comLine', " = 'FLOAT()';", "");
}); 

$(document).on('click', '.comDouble', function (event) {
  insertTextZ('comLine', " = 'DOUBLE()';", "");
}); 

$(document).on('click', '.comBoolean', function (event) {
  insertTextZ('comLine', " = 'BOOLEAN';", "");
}); 

$(document).on('click', '.comChar', function (event) {
  insertTextZ('comLine', " = 'CHAR';", "");
}); 

$(document).on('click', '.comVarchar', function (event) {
  insertTextZ('comLine', " = 'VARCHAR()';", "");
}); 


$(document).on('click', '.comText', function (event) {
  insertTextZ('comLine', " = 'TEXT';", "");
}); 



