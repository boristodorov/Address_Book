
<?php
    mb_internal_encoding('UTF-8');
    $pageTitle = 'Forma';
    include './include/header.php';
    $groups = array(1=>'Prijatelji', 2=>'Kolege', 3=>'Bivse', 4=>'Buduce');
            
    
   if($_POST){
     //Normalizacija podataka
    /*
     * ako imamo post request onda mozemo da pocnemo normalizaciju i validaciju podataka koji nam dolaze,
     * preko forme
     */
       //funkcija trim() skracuje string za nepotrebne intervale i simbole '    boris    ', 'boris'
       $username = trim($_POST['username']);
       $phone    = trim($_POST['phone']);
       $selectedGroup = (int)$_POST['groupe'];
       
       //deklarisemo promenljivu $error i dajemo vrednost false, nakon toga u if konstrukciji ako imamo neku gresku dajemo vrednost true
       $error= FALSE;
       
       //Validacija podataka 
       /*
        * mb_strlen() funkcija uzima kao parametar promenljivu i broji koliko sibola ima dati string,
        * ali da bi smo koristili ovu funkciju moramo podesiti encoding na UTF-8, 
        * to radimo pomocu mb_internal_encoding('UTF-8')
        */
       if (mb_strlen($username) <4){
           echo '<p>Pogresno ime</p>';
           $error=TRUE;
       }
       if(mb_strlen($phone)<4 || mb_strlen($phone)>12){
           echo '<p>Pogresan broj</p>';
           $error=TRUE;
       }
       
       /*
        *  array_key_exists() funkcija prosto proverava da li postoji dati kljuc u datom array-u, kao argumente 
        * ova funkcija uzima promenljivu koja cuva kljuc i array u kome se nalazi, ali kada bi ova funkcija 
        * bila tacna onda bi usli u if konstrukciju, zato okrecemo logiku 
        *        
        */
       if(!array_key_exists($selectedGroup, $groups)){
           echo '<p>Pogresna grupa</p>';
           $error=TRUE;
       }
       
       /*
        * Podaci koji su uspesno prosli normalizaciju i validaciju zapisujemo u tekstualni fajl,
        * Ako promenljiva $error u if konstrukciji daje vrednost true onda se pokazuju poruke za greske u mi 
        * ne mozemo da zapisemo te podatke, zato opet okrecemo logiku ako promenljiva $error daje vrednost false 
        * onda mozemo da krenemo sa zapisom podataka!
        */
       if (!$error){
           
           $results = $username.'!'.$phone.'!'.$selectedGroup;
           echo $results;
       }
       
       
       
   }
    
    
?>

<a href="index.php" >spisak</a>
<form method="POST" >
    <div>Ime: <input type="text" name="username"></div>
    <div>Telefon: <input type="text" name="phone"></div>
    <div>
        <select name="groupe">
           <?php
           foreach ($groups as $key=>$value) {
               echo '<option value="'.$key.'">'.$value.'</option>';
           }
           ?>
        </select>
    </div>
    
    <div><input type="submit" value="Dodaj" ></div>   
</form>

<?php
include './include/footer.php';
?>