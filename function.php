<!DOCTYPE html>
<html lang = "en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content = "width=device-width, initial-scale=1.0">
     <title> Document </title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<script>


     
     function Get_Candidates(Name, Value){
         

          var data_t = {
               "namer" : Name + ',' + Value
          }

          console.log(data_t)
          var jsonStr = JSON.stringify(data_t);
          var Ans;
          $.ajax({
              url:'worker_with_db.php',
              method :'get',
              dataType: 'json',
              contentType: "application/json; charset=utf-8",
              data: {'dataquery' : jsonStr}, // если надо
              async:false,
              
              success: function(a_data){
                    //console.log(a_data);
                    //console.log(typeof(a_data));

                    Ans = a_data;

                    //Ans = JSON.parse(a_data);

                   // console.log(Ans);console.log(a_data);
                    //console.log($.parseJSON(a_data));  

              },
              beforeSend: function () {
                    console.log(jsonStr);
              },
              error: function (jqXHR, exception) {
                    if (jqXHR.status === 0) {
                         alert('Not connect. Verify Network.');
                    } else if (jqXHR.status == 404) {
                         alert('Requested page not found (404).');
                    } else if (jqXHR.status == 500) {
                         alert('Internal Server Error (500).');
                    } else if (exception === 'parsererror') {
                         alert('Requested JSON parse failed.');
                    } else if (exception === 'timeout') {
                         alert('Time out error.');
                    } else if (exception === 'abort') {
                         alert('Ajax request aborted.');
                    } else {
                         alert('Uncaught Error. ' + jqXHR.responseText);
                    }
               }
          });
          //console.log(Ans);
          //Ans = JSON.parse(Ans);

          //console.log(Ans);

          var real_Ans = [];

          console.log(Ans);

          
          for(let i = 1; i <= Object.keys(Ans).length; i += 1){
             
               let cur_data = {
                    'Имя' : Ans[i][0],
                    'Предмет' : Ans[i][1],
                    'Рейтинг' : Ans[i][2],
                    'Описание' : Ans[i][3]
               }
             
               real_Ans.push(cur_data);
          }
     

          return real_Ans;
     }
     


     function Choose(Ans, Name, L, R){

          const arr = Ans || [];

          var real_Ans = [];
          for(let i = 0; i < arr?.length; i += 1){
               if(Ans[i][Name] >= L && Ans[i][Name] <=R)
                    real_Ans.push(Ans[i]);
          }
          return real_Ans;
     }


     let Candidates = Get_Candidates('Предмет', 'Информатика');

     console.log(Candidates);
     console.log(Choose(Candidates, 'Рейтинг', 7, 10));

    

        
</script>
</body>
</html>