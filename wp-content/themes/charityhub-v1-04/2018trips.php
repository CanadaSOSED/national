<?php
//connect to db
require_once('include/portal_db_config.php');
?>

<?php
$tripsQuery = mysql_query("SELECT * FROM `VolunteerTrip` WHERE YEAR = '2017'") or die(mysql_error());

if (mysql_num_rows($tripsQuery) <=  0) {
?>
	<p>
	We are currently working on organizing trips for 2018. For any trip related question, feel free to email us at <a href="mailto:trips@studentsofferingsupport.ca"> trips@studentsofferingsupport.ca. </a>
	</p>

<?php

}

else {


?>

    <table style="width:100%; text-align:center; border-collapse: collapse;">
      <tr>
        <th>Chapter</th>
        <th>Destination</th>
        <th>Departure City</th>
        <th>Community: Project</th>
        <th>More Info/Apply</th>
        <th>Dates</th>
      </tr>
      <tr>
        <td>University of Alberta</td>
        <td>Costa Rica</td>
        <td>Calgary</td>
        <td>Quizarra</td>
        <td><a href="https://alberta.soscampus.com/trips/">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Calgary</td>
        <td>Costa Rica</td>
        <td>Calgary</td>
        <td>Quizarra</td>
        <td><a href="https://calgary.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Carleton University</td>
        <td>Guatemala</td>
        <td>Montreal</td>
        <td>Las Arrugas</td>
        <td><a href="https://carleton.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Glendon/York</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://glendon.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Guelph</td>
        <td>Guatemala</td>
        <td>Toronto</td>
        <td>Ciudad Vieja</td>
        <td><a href="https://guelph.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Laurentian University</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://laurentian.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Laurier University</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://laurier.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Laurier University</td>
        <td>Guatemala</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://laurier.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>McGill University</td>
        <td>Guatemala</td>
        <td>Montreal</td>
        <td>Las Arrugas</td>
        <td><a href="https://mcgill.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>McMaster University</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://mcmaster.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Memorial University</td>
        <td>Costa Rica</td>
        <td>St. John's</td>
        <td>Quizarra</td>
        <td><a href="https://memorial.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Ottawa</td>
        <td>Guatemala</td>
        <td>Montreal</td>
        <td>Las Arrugas</td>
        <td><a href="https://ottawa.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Queen's University</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://queens.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Ryerson University</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://ryerson.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Simon Fraser University</td>
        <td>Guatemala</td>
        <td>Vancouver</td>
        <td>Santa Apolonia</td>
        <td><a href="https://sfu.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>U of T - St. George</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://toronto.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>UBC</td>
        <td>Guatemala</td>
        <td>Vancouver</td>
        <td>Santa Apolonia</td>
        <td><a href="https://ubc.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>UBCO</td>
        <td>Guatemala</td>
        <td>Vancouver</td>
        <td>Santa Apolonia</td>
        <td><a href="https://ubco.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>UTM - Mississauga</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://utm.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Victoria</td>
        <td>Guatemala</td>
        <td>Vancouver</td>
        <td>Santa Apolonia</td>
        <td><a href="https://uvic.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Vancouver Island University</td>
        <td>Guatemala</td>
        <td>Vancouver</td>
        <td>Santa Apolonia</td>
        <td><a href="https://viu.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Waterloo</td>
        <td>Guatemala</td>
        <td>Toronto</td>
        <td>Ciudad Vieja</td>
        <td><a href="https://waterloo.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>Western University</td>
        <td>Guatemala</td>
        <td>Toronto</td>
        <td>Ciudad Vieja</td>
        <td><a href="https://western.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Windsor</td>
        <td>Costa Rica</td>
        <td>Detroit/Toronto</td>
        <td>Namaldi</td>
        <td><a href="https://windsor.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Windsor</td>
        <td>Nicaragua</td>
        <td>Detroit/Toronto</td>
        <td>Santa Clara</td>
        <td><a href="https://windsor.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>University of Windsor</td>
        <td>Guatemala</td>
        <td>Toronto</td>
        <td>Chuacruz</td>
        <td><a href="https://windsor.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
      <tr>
        <td>York University - Keele</td>
        <td>Nicaragua</td>
        <td>Toronto</td>
        <td>Pueblo Viejo</td>
        <td><a href="https://york.soscampus.com/trips">Link Here</a></td>
        <td>Coming Soon!</td>
      </tr>
    </table>
<br/>


<?php
	}




?>
