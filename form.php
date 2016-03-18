
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
       //funkcija trim() skracuje string za nepotrebne intervale '    boris    ', 'boris'
       $username = trim($_POST['username']);
       $phone    = trim($_POST['phone']);
       $selectedGroup = (int)$_POST['groupe'];
       
       //Validacija podataka 
       /*
        * mb_strlen() funkcija uzima kao parametar promenljivu i broji koliko sibola ima dati string,
        * ali da bi smo koristili ovu funkciju moramo podesiti encoding na UTF-8, 
        * to radimo pomocu mb_internal_encoding('UTF-8')
        */
       if (mb_strlen($username) <4){
           echo '<p>Pogresno ime</p>';
       }
       if(mb_strlen($phone)<4 || mb_strlen($phone)>12){
           echo '<p>Pogresan broj</p>';
       }
       
       /*
        *  array_key_exists() funkcija prosto proverava da li postoji dati kljuc u datom array-u, kao argumente 
        * ova funkcija uzima promenljivu koja cuva kljuc i array u kome se nalazi, ali kada bi ova funkcija 
        * bila tacna onda bi usli u if konstrukciju, zato okrecemo logiku 
        *        
        */
       if(!array_key_exists($selectedGroup, $groups)){
           echo '<p>Pogresna grupa</p>';
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