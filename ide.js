let editor;
window.onload=function(){
    editor=ace.edit("editor");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/python");
}
function executeCode(){
    $.ajax({
        url:"auto_parts_sites/ide/compiler.php",

        method:"POST",

        data:{
            code: editor.getSession().getValue()
        },

        success: function(response){
            $(".output").text(response)
        }
    })
}