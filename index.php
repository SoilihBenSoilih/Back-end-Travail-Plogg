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
        <link rel="stylesheet" href="css/style.css">
        <!--<script src="js/script.js"></script>-->

    </head>
    
    
    <body>
        
       <div class="container">
            <div class="divider"></div>
            <div class="heading">
                <h2>Back-end</h2>
            </div>
                
           <div class="row">
               <div class="col-lg-10 col-lg-offset-1">
                    <form id="contact-form" method="POST" action="php/cible.php">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="date_debut">Date début <span class="blue">*</span></label>
                                <input id="date_debut" type="date" name="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="date_fin">Date fin<span class="blue">*</span></label>
                                <input id="date_fin" type="date" name="date_fin" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="baseline">Baseline<span class="blue">*</span></label>
                                <input id="baseline" type="number" name="baseline" class="form-control" placeholder="Baseline" required>
                            </div>
                            <div class="col-md-6">
                                <label for="total">Total<span class="blue">*</span></label>
                                <input id="total" type="number" name="total" class="form-control" placeholder="Total" required>
                            </div>
                            <div class="col-md-12">
                                <p class="blue"><strong>* Ces informations sont requises.</strong></p>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="button1" value="Envoyer">
                            </div>    
                        </div>
                    </form>
                </div>
           </div>
        </div>
        
    </body>

</html>