
<link href='http://infojegyzet.hu/webszerkesztes/mysql/megyeink/megyeink.css' type='text/css' rel ='stylesheet'>



<table id='megyeink' cellspacing=5 width= 50%>

	<tr>
		<td width=25%> név      </td>
		<td width=50%> befizetés  </td>
		<td width=25%> összeg     </td>
	</tr>


<?
    $adb = mysqli_connect( "localhost", "root", NULL, "tagdij" );

    $adatok = mysqli_query( $adb , "SELECT ugyfel.nev AS nevek, ugyfel.azon AS azonos ,SUM(befiz.osszeg) AS osszegek  FROM ugyfel, befiz WHERE ugyfel.azon = befiz.azon GROUP BY ugyfel.nev ") ;

	
    while( $lekerdezes = mysqli_fetch_array($adatok) )
    {
		$nev = $lekerdezes['nevek'];
		$kod = $lekerdezes['azonos'];
	print "
		<tr>
			<td> $lekerdezes[nevek]</td>
			<td>";  
			$lekerde = mysqli_query($adb, " SELECT befiz.datum AS befizetes , befiz.osszeg AS osszeger  FROM befiz, ugyfel WHERE $kod = ugyfel.azon AND befiz.azon = ugyfel.azon  ");
			while($kerdezes = mysqli_fetch_array($lekerde))
			{
				echo $kerdezes['befizetes'];
				echo "| ". $kerdezes['osszeger'] . " ft";
				echo "<br>";
			}
			
			
			
			
			
			echo"</td>
			<td> $lekerdezes[osszegek] ft</td>
		</tr>
	" ;

    }










    @$osszeg = mysqli_fetch_array( mysqli_query( $adb , "

					SELECT SUM(osszeg) AS fullossz 
					FROM befiz
    " ) ) ;





    print "
		<tr>
			<td> Összesen:    </td>
			<td>  </td>
			<td> $osszeg[fullossz]   </td>
		</tr>
    " ;




    mysqli_close( $adb ) ;

?>

</table>
