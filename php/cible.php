<!DOCTYPE html>
<html>
    <head>
        <title>Travail - back-end</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    
    
    <body>
        
        
        
        <?php

    $array = array("date_debut" => "", "date_fin" => "", "baseline" => "", "total" => "");
    $arrayJS = array("diff" => "");

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    { 
        $date_debut = $array["date_debut"] = test_input($_POST["date_debut"]);
        $date_fin = $array["date_fin"] = test_input($_POST["date_fin"]);
        $baseline = $array["baseline"] = test_input($_POST["baseline"]);
        $total = $array["total"] = test_input($_POST["total"]);
        

        $dates = getDatesBetween($date_debut, $date_fin);     
        $temp = TransformToDateTime($dates);
        $diff = date_diff($temp[0],$temp[count($dates) - 1]);
        
        $array["diff"] = $diff;                        
        
        $OnePercent = (($total * 1)/100);
        $sommeTotale=0;
        $sommeJoursSansWeekEnd=0;

        for ($i=0; $i < count($dates); $i++) { 
            $arrayF[ $dates[$i] ] = 0;
        }
        
        for ($i=0; $i < count($dates); $i++) { 
            if (!WeekEndOrNot($dates[$i])) {
                $sommeJoursSansWeekEnd++;
            }
        }
        
        $minValue = $baseline / $sommeJoursSansWeekEnd;

        foreach ($arrayF as $key => $value) {

            $val = rand_float($minValue, $total,100);
            $total = $total - $val;
            $arrayF[$key] = $val;
                
            if (WeekEndOrNot(array_search($val, $arrayF))) {
                $arrayF[$key] = 0;
            }
                
            if ($total<0) {
                break; 
            }
                
        }
      
        json_encode($arrayJS);
        
        
    }

    function test_input($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function getDatesBetween($start, $end)
    {
        if($start > $end)
        {
            return false;
        }    

        $sdate    = strtotime($start);
        $edate    = strtotime($end);

        $dates = array();

        for($i = $sdate; $i <= $edate; $i += strtotime('+1 day', 0))
        {
            $dates[] = date('Y-m-d', $i);
        }

        return $dates;
    }

    function TransformToDateTime($tab)
    {
        $dates = array();


        for($i = 0; $i < count($tab); $i++)
        {
            $dates[] = date_create($tab[$i]);
        }

        return $dates;
    }

    function WeekEndOrNot($dateVariable)
    {
       $year = substr($dateVariable , 0, 4); 
       $month = substr($dateVariable , 5, 2); 
       $day = substr($dateVariable , 8, 2);
       $timestamp = mktime(0, 0, 0, $month, $day, $year);
       $searchDay = date('w', $timestamp);
       $Variable=null;

       if ($searchDay == 0 || $searchDay == 6) {
           $Variable = true;
       }
       else
       {
          $Variable = false;
       }
        
       return $Variable;
    }

    function rand_float($st_num=0,$end_num=1,$mul=1000000)
    {
        if ($st_num>$end_num) return false;
        return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
    }


    function  distribute($min, $total, $dates){
    if($total<=0)
      return;

        $val = 0;

      foreach ($dates as $key => $value) {
                
           $val = rand_float($min, $total,100);
           $total = $total - $val;
           $old = $val;
           $dates[$key] = $val + $old;
  
            if (WeekEndOrNot(array_search($value, $dates))) {
                $dates[$key] = 0;
              }
                
        }

      distribute($min,$total,$dates);  
    }
 
?>
        
       <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Back-end</h2>
            </div>
               <div class="row">
               <div class="col-lg-10 col-lg-offset-1">
                  <div id="contact-form">   
                    <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Date</th>
                              <th scope="col">Value</th>
                            </tr>
                          </thead>
                          <tbody>
                              
                              <?php
                                $i=1;
                                
                                        foreach ($arrayF as $key => $value) {
                                            print("<tr>
                                                  <th scope=\"row\">$i</th>
                                                    <td>$key</td>
                                                    <td>$value</td>
                                                  </tr>");
                                            $i++;
                                        }
  
                              ?>
                          </tbody>
                    </table>
                    </div>
                </div>
           </div>
        </div>
        
    </body>

</html>





