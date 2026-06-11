<?php
	/* Libchart - PHP chart library
	 * Copyright (C) 2005-2011 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
	
	/**
	 * Horizontal bar chart demonstration
	 *
	 */

	include "../libchart/classes/libchart.php";
	$chart = new HorizontalBarChart(600, 170);

	$dataSet = new XYDataSet();
	
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));

	
	include("conn.php");
			$sql='SELECT city.cityName, SUM(transaction.amount) 
FROM city, transaction
WHERE transaction.cityId = city.cityId
AND reporttypeId=1
GROUP BY transaction.cityId 
ORDER BY SUM(transaction.amount) DESC
LIMIT 5';
			$result = mysql_query($sql);
     if(mysql_num_rows($result)) {
       while($row = mysql_fetch_row($result))
       {
	   $dataSet->addPoint(new Point($row[0],$row[1]));
	
          //echo '<b>'.$row[0].', with N'.number_format($row[1]).' Egunje!</b>';
		  //echo '<br/>';
       }
     } else {
       echo 'No State Name Selected';
     }
$chart->setTitle("Top 5 Egunje! Cities");
	$chart->render("generated/demo2.png");
?>

	<img alt="Horizontal bars chart"  src="generated/demo2.png" style="border: 1px solid gray;"/>

