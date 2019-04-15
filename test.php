<html>
    <head>
        <title>How to check/uncheck a checkbox using jQuery</title>
    </head>
    <body>
        <h2>Checking and Unchecking a Check box using jQuery</h2>

        Select All : <input id="checkall" class='' type="checkbox" >



        Checkbox 1 :<input value="1" class='checkboxes' type="checkbox" name="email[]">


        Checkbox 2 :<input value="2" class='checkboxes' type="checkbox" name="lname[]">


        Checkbox 3 :<input value="3" class='checkboxes' type="checkbox" name="fname[]">


        </div>

        <script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
        <script>
             $("#checkall").click(function (){
     if ($("#checkall").is(':checked')){
        $(".checkboxes").each(function (){
           $(this).prop("checked", true);
           });
        }else{
           $(".checkboxes").each(function (){
                $(this).prop("checked", false);
           });
        }
        });
        </script>
    </body>
</html>


Read more: https://javarevisited.blogspot.com/2017/07/how-to-checkuncheck-checkbox-using-jQuery-example.html#ixzz5jwyyKT2M
