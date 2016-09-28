/*
http://joelvasallo.com/mortgage.html
This JS code for mortgage calculator
*/
function convert_month(month) {
	if (month == 1) { month = "January"; }
	else if (month == 2) { month = "February"; }
	else if (month == 3) { month = "March"; }
	else if (month == 4) { month = "April"; }
	else if (month == 5) { month = "May"; }
	else if (month == 6) { month = "June"; }
	else if (month == 7) { month = "July"; }
	else if (month == 8) { month = "August"; }
	else if (month == 9) { month = "September"; }
	else if (month == 10) { month = "October"; }
	else if (month == 11) { month = "November"; }
	else if (month == 12) { month = "December"; }
	return month;
}

function calculate_monthly_payment() {
	// setting these as local variables...easier to read vs huge parse float equations.
	var loan_amount = parseFloat(jQuery('#amount').val());
	var interest_rate = parseFloat(jQuery('#interest').val())/100;
	var monthly_interest_rate = interest_rate/12;
	var length_of_mortgage = parseInt(jQuery('#term-months').val());
	// begin the formula for calculate the fixed monthly payment
	// REFERENCE: P = L[c(1 + c)n]/[(1 + c)n - 1]
	var top_val = monthly_interest_rate * Math.pow((1+monthly_interest_rate),length_of_mortgage);
	var bot_val = Math.pow((1 + monthly_interest_rate),(length_of_mortgage))-1;
	var monthly_mortgage = parseFloat(loan_amount*(top_val/bot_val)).toFixed(2);
	calculate_amortization(loan_amount, monthly_mortgage, monthly_interest_rate, length_of_mortgage);
	jQuery('#total').val(monthly_mortgage);
}

function calculate_amortization(loan_amount, monthly_mortgage, monthly_interest_rate, length_of_mortgage) {
	var month = parseInt(jQuery('#month').val());
		var year = parseInt(jQuery('#year').val());
	var tableData = "<tr> \
						<th>Month</th> \
						<th>Balance</th> \
						<th>Payment</th> \
						<th>Principal</th> \
						<th>Interest</th> \
						</tr>";
	// Initializing the empty totals
	var total_mortgage = parseFloat(0);
	var total_principal = parseFloat(0);
	var total_interest = parseFloat(0);
	for(i=length_of_mortgage; i>0; i--) {
		var monthly_interest = parseFloat(loan_amount * monthly_interest_rate).toFixed(2);
		var monthly_principal = parseFloat(monthly_mortgage - monthly_interest).toFixed(2);
						 total_mortgage = parseFloat(total_mortgage) + parseFloat(monthly_mortgage);
		total_principal = parseFloat(total_principal) + parseFloat(monthly_principal);
		total_interest = parseFloat(total_interest) + parseFloat(monthly_interest);
		var monthStr = convert_month(month);
		var tablerow = "<tr> \
							<td>" + monthStr + " " + year + "</td> \
							<td>$" + parseFloat(loan_amount).toFixed(2) + "</td> \
							<td>$" + monthly_mortgage + "</td> \
							<td>$" + monthly_principal + "</td> \
							<td>$" + monthly_interest + "</td> \
						</tr>";
		tableData = tableData + tablerow;
		if(month==12) {
			month=1;
			year++;
		}
		else {
			month++;
		}
		loan_amount = parseFloat(loan_amount - monthly_principal).toFixed(2);
	}
	tablerow = "<tr> \
						<td></td> \
					<td></td> \
											<td><strong>$" + parseFloat(total_mortgage).toFixed(2) + "</strong></td> \
											<td><strong>$" + parseFloat(total_principal).toFixed(2) + "</strong></td> \
											<td><strong>$" + parseFloat(total_interest).toFixed(2) + "</strong></td> \
								</tr>";
	tableData = tableData + tablerow;
	jQuery('h3#amortization-header').html('Amortization Schedule');
	jQuery('#total_interest').val(parseFloat(total_interest).toFixed(2));
	jQuery('table#amortization').html(tableData);
}

jQuery('#start-date').keyup(calculate_monthly_payment);
jQuery('#amount').keyup(calculate_monthly_payment);
jQuery('#interest').keyup(calculate_monthly_payment);
jQuery('#term-months').keyup(calculate_monthly_payment);


/*
http://www.mortgagecalculator.biz/c/free.php
This JS code for Home Affordability Calculator
*/
function computeMonthlyPayment(prin, numPmts, intRate) {

	var pmtAmt = 0;

	if(intRate == 0) {
	   pmtAmt = prin / numPmts;
	} else {
		 intRate = intRate / 100.0 / 12;

	   var pow = 1;
	   for (var j = 0; j < numPmts; j++)
		  pow = pow * (1 + intRate);

	   pmtAmt = (prin * pow * intRate) / (pow - 1);

	}

	return pmtAmt;
}

function fn(num, places, comma) {

	var isNeg=0;

    if(num < 0) {
       num=num*-1;
       isNeg=1;
    }

    var myDecFact = 1;
    var myPlaces = 0;
    var myZeros = "";
    while(myPlaces < places) {
       myDecFact = myDecFact * 10;
       myPlaces = Number(myPlaces) + Number(1);
       myZeros = myZeros + "0";
    }
    
	onum=Math.round(num*myDecFact)/myDecFact;
		
	integer=Math.floor(onum);

	if (Math.ceil(onum) == integer) {
		decimal=myZeros;
	} else{
		decimal=Math.round((onum-integer)* myDecFact)
	}
	decimal=decimal.toString();
	if (decimal.length<places) {
        fillZeroes = places - decimal.length;
	   for (z=0;z<fillZeroes;z++) {
        decimal="0"+decimal;
        }
     }

   if(places > 0) {
      decimal = "." + decimal;
   }

   if(comma == 1) {
	integer=integer.toString();
	var tmpnum="";
	var tmpinteger="";
	var y=0;

	for (x=integer.length;x>0;x--) {
		tmpnum=tmpnum+integer.charAt(x-1);
		y=y+1;
		if (y==3 & x>1) {
			tmpnum=tmpnum+",";
			y=0;
		}
	}

	for (x=tmpnum.length;x>0;x--) {
		tmpinteger=tmpinteger+tmpnum.charAt(x-1);
	}


	finNum=tmpinteger+""+decimal;
   } else {
      finNum=integer+""+decimal;
   }

    if(isNeg == 1) {
       finNum = "-" + finNum;
    }

	return finNum;
}

function sn(num) {

	num=num.toString();

	var len = num.length;
	var rnum = "";
	var test = "";
	var j = 0;

	var b = num.substring(0,1);
	if(b == "-") {
	  rnum = "-";
	}

	for(i = 0; i <= len; i++) {

	  b = num.substring(i,i+1);

	  if(b == "0" || b == "1" || b == "2" || b == "3" || b == "4" || b == "5" || b == "6" || b == "7" || b == "8" || b == "9" || b == ".") {
		 rnum = rnum + "" + b;

	  }

	}

	if(rnum == "" || rnum == "-") {
	  rnum = 0;
	}

	rnum = Number(rnum);

	return rnum;

}

function computeForm(form) {
	if (window.matchMedia('(max-width: 1023px)').matches){
		jQuery('#secondary').hide();
	}
	
	var Vclosingcosts = document.calc.closingcosts.value; 
	if(Vclosingcosts == 0 || Vclosingcosts == "") {
		Vclosingcosts = 0;
	}	  
	var Vprincipal =sn(parseFloat(document.calc.principal.value) + parseFloat(Vclosingcosts));
	var VintRate = sn(document.calc.intRate.value);
	var VnumYears = sn(document.calc.numYears.value);
	var VannualTax = document.calc.annualTax.value;
	var VmonthlyTax =0;
	if(VannualTax == 0 || VannualTax == "") {
		VannualTax = 0;
		VmonthlyTax =0;
	} else {
		//VannualTax = sn((VannualTax * document.calc.homevalue.value)/100);
		VmonthlyTax = VannualTax / 12;
		VmonthlyTax *= 100;
		VmonthlyTax = Math.round(VmonthlyTax);
		VmonthlyTax /= 100;
	}

	var VannualInsurance = document.calc.annualInsurance.value;
	var VmonthlyInsurance = 0;
	if(VannualInsurance == 0 || VannualInsurance == "") {
		VannualInsurance = 0;
		VmonthlyInsurance = 0;
	} else {
		//VannualInsurance = sn((VannualInsurance * document.calc.homevalue.value)/100);
		VmonthlyInsurance = VannualInsurance / 12;
		VmonthlyInsurance *= 100;
		VmonthlyInsurance = Math.round(VmonthlyInsurance);
		VmonthlyInsurance /= 100;
	}

	var Vhomevalue = document.calc.homevalue.value;
	var VmonthlyPMI = document.calc.monthlyPMI.value;

	if(VmonthlyPMI == 0 || VmonthlyPMI == "" || Vhomevalue > 1.249999999*Vprincipal ) {
		VmonthlyPMI = 0;
	}	  
	else {
		//VmonthlyPMI = sn((VmonthlyPMI * document.calc.principal.value)/100);
		VmonthlyPMI = VmonthlyPMI / 12;
		VmonthlyPMI *= 100;
		VmonthlyPMI = Math.round(VmonthlyPMI);
		VmonthlyPMI /= 100;
	}

	var VotherPmts = Number(VmonthlyTax) + Number(VmonthlyInsurance) + Number(VmonthlyPMI);

	var VnumPmts = VnumYears * 12;

	var VpmtAmt = computeMonthlyPayment(Vprincipal, VnumPmts, VintRate);
	var VtotalMtgPmt = Number(VpmtAmt) + Number(VotherPmts);
	var Vdownpayment =sn(parseFloat(document.calc.homevalue.value) - parseFloat(document.calc.principal.value));

	/*document.calc.monthlyPI.value = "$" + fn(VpmtAmt,0,1);
	document.calc.otherPmts.value = "$" + fn(VotherPmts,0,1);
	document.calc.monthlyPmt.value = "$" + fn(VtotalMtgPmt,0,1);
	document.calc.downpayment.value = "$" + fn(Vdownpayment,0,1);*/
	jQuery('#monthlyPmt').html("<h2><strong>$" + fn(VtotalMtgPmt,2,1) + '</strong></h2>');
	jQuery('#monthlyPI').html("<h2>$" + fn(VpmtAmt,2,1) + '</h2>');
	jQuery('#otherPmts').html("<h2>$" + fn(VotherPmts,2,1) + '</h2>');	
	jQuery('#downpayment').html("<h2>$" + fn(Vdownpayment,2,1) + '</h2>');
	
	jQuery("#calc > div:first-of-type").removeAttr( 'class' );
	jQuery('#secondary').show( "slide" );
	
	if (window.matchMedia('(max-width: 1023px)').matches){
		jQuery('html, body').animate({
			scrollTop: jQuery('#secondary').offset().top - 100
		}, 500);
	}
	else {
		jQuery('html, body').animate({
			scrollTop: jQuery('#masthead').offset().top
		}, 500);
	}
	
}

function monthlyAmortSched(form, viewat) {
	  
	var Vprincipal = sn(parseFloat(document.calc.principal.value) + parseFloat(document.calc.closingcosts.value));
	var VintRate = sn(document.calc.intRate.value);
	var VnumYears = sn(document.calc.numYears.value);
	var VannualTax = document.calc.annualTax.value;
	var VmonthlyTax =0;
	if(VannualTax == 0 || VannualTax == "") {
		VannualTax = 0;
		VmonthlyTax =0;
	} else {
		VannualTax = sn(VannualTax);
		VmonthlyTax = VannualTax / 12;
		VmonthlyTax *= 100;
		VmonthlyTax = Math.round(VmonthlyTax);
		VmonthlyTax /= 100;
	}

	var VannualInsurance = document.calc.annualInsurance.value;
	var VmonthlyInsurance = 0;
	if(VannualInsurance == 0 || VannualInsurance == "") {
		VannualInsurance = 0;
		VmonthlyInsurance = 0;
	} else {
		VannualInsurance = sn(VannualInsurance);
		VmonthlyInsurance = VannualInsurance / 12;
		VmonthlyInsurance *= 100;
		VmonthlyInsurance = Math.round(VmonthlyInsurance);
		VmonthlyInsurance /= 100;
	}

	var VmonthlyPMI = document.calc.monthlyPMI.value;
	if(VmonthlyPMI == 0 || VmonthlyPMI == "") {
		VmonthlyPMI = 0;
	} else {
		VmonthlyPMI = sn(VmonthlyPMI);
	}

	var VotherPmts = Number(VmonthlyTax) + Number(VmonthlyInsurance) + Number(VmonthlyPMI);

	var VnumPmts = VnumYears * 12;

	var pmtAmt = computeMonthlyPayment(Vprincipal, VnumPmts, VintRate);
	var VtotalMtgPmt = Number(pmtAmt) + Number(VotherPmts);

	var prin = Vprincipal;

	var Vint = VintRate;

	if(Vint >= 1) {
		Vint /= 100;
	}
	Vint /= 12;

	var nPer = VnumPmts;

	var intPort = 0;
	var accumInt = 0;
	var prinPort = 0;
	var accumPrin = 0;
	var count = 0;
	var pmtRow = "";
	var pmtNum = 0;

	var today = new Date();
	var dayFactor = today.getTime();
	var pmtDay = today.getDate();
	var loanMM = today.getMonth() + 1;
	var loanYY = today.getYear();
	if(loanYY < 1900) {
		loanYY += 1900;
	}
	var loanDate = (loanMM + "/" + pmtDay + "/" + loanYY);
	var monthMS = 86400000 * 30.4;
	var pmtDate = 0;
	var displayPmtAmt = 0;
	var accumYearPrin = 0;
	var accumYearInt = 0;

	while(count < nPer) {

		if(count < (nPer - 1)) {

			intPort = prin * Vint;
			intPort *= 100;
			intPort = Math.round(intPort);
			intPort /= 100;

			accumInt = Number(accumInt) + Number(intPort);
			accumYearInt = Number(accumYearInt) + Number(intPort);

			prinPort = Number(pmtAmt) - Number(intPort);
			prinPort *= 100;
			prinPort = Math.round(prinPort);
			prinPort /= 100;

			accumPrin = Number(accumPrin) + Number(prinPort);
			accumYearPrin = Number(accumYearPrin) + Number(prinPort);

			prin = Number(prin) - Number(prinPort);

			displayPmtAmt = Number(prinPort) + Number(intPort);

		} else {

			intPort = prin * Vint;
			intPort *= 100;
			intPort = Math.round(intPort);
			intPort /= 100;

			accumInt = Number(accumInt) + Number(intPort);
			accumYearInt = Number(accumYearInt) + Number(intPort);

			prinPort = prin;

			accumPrin = Number(accumPrin) + Number(prinPort);
			accumYearPrin = Number(accumYearPrin) + Number(prinPort);

			prin = 0;

			//pmtAmt = Number(intPort) + Number(prinPort);
			displayPmtAmt = Number(prinPort) + Number(intPort);
		}

		count = Number(count) + Number(1);

		pmtNum = Number(pmtNum) + Number(1);

		dayFactor = Number(dayFactor) + Number(monthMS);

		pmtDate = new Date(dayFactor);

		pmtMonth = pmtDate.getMonth();

		pmtMonth = pmtMonth + 1;

		pmtYear = pmtDate.getYear();
		if(pmtYear < 1900) {
			pmtYear += 1900;
		}


		pmtString = (pmtMonth + "/" + pmtDay + "/" + pmtYear);

		pmtRow += "<tr><td align=right><font face='arial'><small>" + pmtNum + "</small></td>";
		pmtRow += "<td align=right><font face='arial'><small>" + pmtString + "</small></td>";
		pmtRow += "<td align=right><font face='arial'><small>" + "$" + fn(prinPort,2,1) + "</small></td>";
		pmtRow += "<td align=right><font face='arial'><small>" + "$" + fn(intPort,2,1) + "</small></td>";
		pmtRow += "<td align=right><font face='arial'><small>" + "$" + fn(displayPmtAmt,2,1) + "</small></td>";
		pmtRow += "<td align=right><font face='arial'><small>" + "$" + fn(prin,2,1) + "</small></td></tr>";

		if(pmtMonth == 12 || count == nPer) {
			pmtRow += "<tr bgcolor='#dddddd'><td align=right><font face='arial'><small>Total</small></td>";
			pmtRow += "<td align=left><font face='arial'><small>" + pmtYear + "</small></td>";
			pmtRow += "<td align=right><font face='arial'><small>" + "$" + fn(accumYearPrin,2,1) + "</small></td>";
			pmtRow += "<td align=right><font face='arial'><small>" + "$" + fn(accumYearInt,2,1) + "</small></td>";
			pmtRow += "<td align=right><font face='arial'><small> </small></td>";
			pmtRow += "<td align=right><font face='arial'><small> </small></td></tr>";

			accumYearPrin = 0;
			accumYearInt = 0;
		}

		if(count > 600) {
			alert("Using your current entries you will never pay off this loan.");
			break;
		} else {
			continue;
		}

	}

	var part1 = "<head><title>Amortization Schedule</title></head>";
	part1 += "<body bgcolor= '#FFFFFF'><br /><br /><center><font face='arial'>";
	part1 += "<big><strong>Amortization Schedule</strong></big></center>";


	var part2 = "<center><table border=1 cellpadding=2 cellspacing=0>";
	part2 += "<tr><td colspan=6><font face='arial'><small><b>Loan ";
	part2 += "Date: " + loanDate + "<br />Principal: $" + fn(Vprincipal,2,1) + "<br /># of ";
	part2 += "Payments: " + nPer + "<br />Interest Rate: " + fn(VintRate,3,0) + "%<br />";
	part2 += "Payment: $" + fn(pmtAmt,2,1) + "</b></small></td></tr><tr><td colspan=6>";
	part2 += "<center><font face='arial'><b>Schedule of Payments</b><br /><font face='arial'>";
	part2 += "<small><small>Please allow for slight rounding differences.</small></small></center></td></tr>";
	part2 += "<tr bgcolor='silver'><td align='center'><font face='arial'><small><b>Pmt #</b></small></td>";
	part2 += "<td align='center'><font face='arial'><small><b>Date</b></small></td>";
	part2 += "<td align='center'><font face='arial'><small><b>Principal</b></small></td>";
	part2 += "<td align='center'><font face='arial'><small><b>Interest</b></small></td>";
	part2 += "<td align='center'><font face='arial'><small><b>Payment</b></small></td>";
	part2 += "<td align='center'><font face='arial'><small><b>Balance</b></small></td></tr>";

	var part3 = ("" + pmtRow + "");

	var part4 = "<tr><td></td><td align='right'><font face='arial'><small><b>Grand Total</b></small></td>";
	part4 += "<td align=right><font face='arial'><small><b>" + "$" + fn(accumPrin,2,1) + "</b></small></td>";
	part4 += "<td align=right><font face='arial'><small><b>" + "$" + fn(accumInt,2,1) + "</b></small></td>";
	part4 += "<td> </td><td> </td></tr></table>";
	part4 += (viewat == '')?"<br /><center><form method='post'><input type='button' value='Close Window' onClick='window.close()'></form></center>":'';
	part4 += "</body></html>";


	var schedule = (part1 + "" + part2 + "" + part3 + part4 + "");
	
	if(viewat == '') {
		reportWin = window.open("","","width=500,height=400,toolbar=yes,menubar=yes,scrollbars=yes");
		reportWin.document.write(schedule);
		reportWin.document.close();	
	}
	else {
		jQuery('#amzdiv').html(schedule).promise().done(function(){
			jQuery('#amzdiv').slideDown();
			jQuery('html, body').animate({
				scrollTop: jQuery('#amzdiv').offset().top
			}, 500);
		});
	}
}

function printAmortSched(form) {
	var schdl = monthlyAmortSched(form); 
}

function clear_results(form) {
	/*document.calc.monthlyPI.value = "";
	document.calc.otherPmts.value = "";
	document.calc.monthlyPmt.value = "";*/
}


//https://www.chfainfo.com/homeownership/mortgage-calculators
function HowMuchCalcIsNumeric(value) {
	if (value == "") { return false; }
	// ensure valid characters
	var mask = "1234567890.,";
	for (var i = 0; i < value.length; i++) {
		if ((mask.indexOf(value.charAt(i)) == -1)) { return false; }
	}
	return true;

}

function HowMuchCalcFormat(input, p, s) {

	// make string look right
	if (p > 0) {
		p++;
		var rounder = "."; for (var i = 1; i < p; i++) { rounder += "0"; } rounder += "5";
		var temp = eval(input) + eval(rounder);
		var decs = "" + (temp - Math.floor(temp));
		decs = decs.substring(2, p + 1);
	}
	else { temp = Math.round(input); }
	var ints = "" + Math.floor(temp);
	var output = ints.substring(ints.length, (ints.length - 1));
	for (i = 1; i < ints.length; i++) {
		if (s) { if (!(i % 3)) { output = s + output; } }
		output = ints.substring((ints.length - i), (ints.length - i - 1)) + output;
	}
	if (p > 0) { output = output + "." + decs; }
	return output;

}

function HowMuchCalcProcess() {
	if (window.matchMedia('(max-width: 1023px)').matches){
		jQuery('#secondary').hide();
	}
	
	// fetch objects
	var i1 = document.getElementById("HowMuchCalcInput1");
	var i2 = document.getElementById("HowMuchCalcInput2");
	var i3 = document.getElementById("HowMuchCalcInput3");
	var i4 = document.getElementById("HowMuchCalcInput4");
	var i5 = document.getElementById("HowMuchCalcInput5");

	var o1 = document.getElementById("HowMuchCalcOutput1");
	var o2 = document.getElementById("HowMuchCalcOutput2");
	var o3 = document.getElementById("HowMuchCalcOutput3");
	var o4 = document.getElementById("HowMuchCalcOutput4");
	var o5 = document.getElementById("HowMuchCalcOutput5");
	var o6 = document.getElementById("HowMuchCalcOutput6");
	var o7 = document.getElementById("HowMuchCalcOutput7");
	var o8 = document.getElementById("HowMuchCalcOutput8");

	//test presence
	if (i1 == null) { alert("Input TextBox 1 is null"); return; }
	if (i2 == null) { alert("Input TextBox 2 is null"); return; }
	if (i3 == null) { alert("Input TextBox 3 is null"); return; }
	if (i4 == null) { alert("Input TextBox 4 is null"); return; }
	if (i5 == null) { alert("Input TextBox 5 is null"); return; }

	if (o1 == null) { alert("Output TextBox 1 is null"); return; }
	if (o2 == null) { alert("Output TextBox 2 is null"); return; }
	if (o3 == null) { alert("Output TextBox 3 is null"); return; }
	if (o4 == null) { alert("Output TextBox 4 is null"); return; }
	if (o5 == null) { alert("Output TextBox 5 is null"); return; }
	if (o6 == null) { alert("Output TextBox 6 is null"); return; }
	if (o7 == null) { alert("Output TextBox 7 is null"); return; }
	if (o8 == null) { alert("Output TextBox 8 is null"); return; }
	
	// reset error message
	jQuery('#HowMuchCalcInput1-err-msg, #HowMuchCalcInput2-err-msg, #HowMuchCalcInput3-err-msg, #HowMuchCalcInput4-err-msg, #HowMuchCalcInput5-err-msg').html("");

	// test numerics
	if (!HowMuchCalcIsNumeric(i1.value)) { jQuery('#HowMuchCalcInput1-err-msg').html("Annual Income must be a number."); jQuery('#HowMuchCalcInput1').focus(); return; }
	if (!HowMuchCalcIsNumeric(i2.value)) { jQuery('#HowMuchCalcInput2-err-msg').html("Monthly Debt must be a number."); jQuery('#HowMuchCalcInput2').focus(); return; }
	if (!HowMuchCalcIsNumeric(i3.value)) { jQuery('#HowMuchCalcInput3-err-msg').html("Down Payment must be a number."); jQuery('#HowMuchCalcInput3').focus(); return; }
	if (!HowMuchCalcIsNumeric(i4.value)) { jQuery('#HowMuchCalcInput4-err-msg').html("Interest Rate must be a number."); jQuery('#HowMuchCalcInput4').focus(); return; }
	if (!HowMuchCalcIsNumeric(i5.value)) { jQuery('#HowMuchCalcInput5-err-msg').html("Loan Term must be a number."); jQuery('#HowMuchCalcInput5').focus(); return; }

	//test ranges
	if ((i4.value < 01) || (i4.value > 20)) { jQuery('#HowMuchCalcInput4-err-msg').html("Loan Rate must be between 1 and 20"); jQuery('#HowMuchCalcInput4').focus(); return; }
	if ((i5.value < 05) || (i5.value > 40)) { jQuery('#HowMuchCalcInput5-err-msg').html("Loan Term must be between 5 and 40"); jQuery('#HowMuchCalcInput5').focus(); return; }

	//format values
	i1.value = HowMuchCalcFormat(i1.value, 0, 0);
	i2.value = HowMuchCalcFormat(i2.value, 0, 0);
	i3.value = HowMuchCalcFormat(i3.value, 0, 0);
	i4.value = HowMuchCalcFormat(i4.value, 3, 0);
	i5.value = HowMuchCalcFormat(i5.value, 0, 0);

	// calculate
	var annualIncome = eval(i1.value);
	var monthlyDebt = eval(i2.value);
	var downPayment = eval(i3.value);
	var interestRate = eval(i4.value);
	var loanLength = eval(i5.value);

	var frontEndRate = .29;
	var backEndRate = .41;
	var monthlyIncome = annualIncome / 12;
	var frontEndPITI = monthlyIncome * frontEndRate;
	var backEndPITI = (monthlyIncome * backEndRate) - monthlyDebt;
	var PITI;
	frontEndPITI < backEndPITI ? PITI = frontEndPITI : PITI = backEndPITI;
	var rateConstant = interestRate / 1200;
	var amv = (1 - Math.pow((1 + rateConstant), (-(loanLength) * 12))) / rateConstant;
	var PITIov = 1.5;
	var houseValue = 1000;
	for (var i = 0; i < 20; i++) {
		var ti = PITIov / 1200 * houseValue;
		var loanAmount = (PITI - ti) * amv;
		houseValue = loanAmount + downPayment;
	}
	var downPercent = downPayment / houseValue * 100;
	var loanToValue = (houseValue - downPayment) / houseValue * 100;
	var moPropTaxIns = houseValue * PITIov / 1200;
	if (loanToValue <= 80) { var moPMI = 0; }
	else {
		var pmi = .50;
		if (loanToValue >= 85) { pmi = .50; }
		if (loanToValue >= 90) { pmi = .50; }
		if (loanToValue >= 95) { pmi = .50; }
		PITIov += pmi;
		houseValue = 1000;
		for (i = 0; i < 20; i++) {
			ti = PITIov / 1200 * houseValue;
			loanAmount = (PITI - ti) * amv;
			houseValue = loanAmount + downPayment;
		}
		downPercent = downPayment / houseValue * 100;
		moPropTaxIns = houseValue * (PITIov - 0.5) / 1200;
		moPMI = houseValue * pmi / 1200;
		loanToValue = (houseValue - downPayment) / houseValue * 100;
	}
	var moPrincipalInterest = loanAmount / amv;
	var totalMonthly = moPrincipalInterest + moPropTaxIns + moPMI;
	if ((loanAmount <= 0) || (houseValue <= 0)) {
		jQuery('#HowMuchCalcInput1-err-msg').html("Using the values you entered, your debt would exceed your income.");
		jQuery('#HowMuchCalcInput1').focus();
		return false;
	}

	// output
	jQuery(o1).html("<h2>$" + HowMuchCalcFormat(houseValue, 0, ",") + '</h2>');
	jQuery(o2).html("<h2>$" + HowMuchCalcFormat(loanAmount, 0, ",") + '</h2>');
	jQuery(o3).html("<h2>" + HowMuchCalcFormat(downPercent, 2, 0) + '%</h2>');
	jQuery(o4).html("<h2>" + HowMuchCalcFormat(loanToValue, 2, 0) + '%</h2>');
	jQuery(o6).html("<h2>$" + HowMuchCalcFormat(moPrincipalInterest, 2, ",") + '</h2>');
	jQuery(o7).html("<h2>$" + HowMuchCalcFormat(moPropTaxIns, 2, ",") + '</h2>');
	jQuery(o8).html("<h2>$" + HowMuchCalcFormat(moPMI, 2, ",") + '</h2>');
	jQuery(o5).html("<h2><strong>$" + HowMuchCalcFormat(totalMonthly, 2, ",") + '</strong></h2>');
	
	//jQuery("#affordcalc > div:first-of-type").attr('id', 'primary');
	//jQuery("#affordcalc > div:first-of-type > div:not(:last-of-type)").attr('class', 'four-column');
	//jQuery("#affordcalc > div:first-of-type").removeClass( "two-column" )
	jQuery("#affordcalc > div:first-of-type").removeAttr( 'class' );
	jQuery('#secondary').show( "slide" );
	
	if (window.matchMedia('(max-width: 1023px)').matches){
		jQuery('html, body').animate({
			scrollTop: jQuery('#secondary').offset().top - 100
		}, 500);
	}
	else {
		jQuery('html, body').animate({
			scrollTop: jQuery('#masthead').offset().top
		}, 500);
	}
	
}

function HowMuchCalcReset() {
	document.getElementById("HowMuchCalcInput1").value = "70000";
	document.getElementById("HowMuchCalcInput2").value = "2000";
	document.getElementById("HowMuchCalcInput3").value = "0";
	document.getElementById("HowMuchCalcInput4").value = "3.5";
	document.getElementById("HowMuchCalcInput5").value = "30";
	document.getElementById("HowMuchCalcOutput1").value = "";
	document.getElementById("HowMuchCalcOutput2").value = "";
	document.getElementById("HowMuchCalcOutput3").value = "";
	document.getElementById("HowMuchCalcOutput4").value = "";
	document.getElementById("HowMuchCalcOutput5").value = "";
	document.getElementById("HowMuchCalcOutput6").value = "";
	document.getElementById("HowMuchCalcOutput7").value = "";
	document.getElementById("HowMuchCalcOutput8").value = "";
	jQuery('#HowMuchCalcInput1-err-msg, #HowMuchCalcInput2-err-msg, #HowMuchCalcInput3-err-msg, #HowMuchCalcInput4-err-msg, #HowMuchCalcInput5-err-msg').html("");
	reset_position();
}

function noenter() {
	return !(window.event && window.event.keyCode == 13);
}


function computeFixedInterestCost(principal, intRate, pmtAmt) { 

   var i = eval(intRate);
   i /= 100;
   i /= 12;

   var prin = eval(principal);
   var intPort = 0;
   var accumInt = 0;
   var prinPort = 0;
   var pmtCount = 0;
   var testForLast = 0;


   //CYCLES THROUGH EACH PAYMENT OF GIVEN DEBT
   while(prin > 0) {

      testForLast = (prin * (1 + i));

      if(pmtAmt < testForLast) {
         intPort = prin * i;
         accumInt = eval(accumInt) + eval(intPort);
         prinPort = eval(pmtAmt) - eval(intPort);
         prin = eval(prin) - eval(prinPort);
      } else {
      //DETERMINE FINAL PAYMENT AMOUNT
      intPort = prin * i;
      accumInt = eval(accumInt) + eval(intPort);
      prinPort = prin;
      prin = 0;
      }

      pmtCount = eval(pmtCount) + eval(1);

      if(pmtCount > 1000 || accumInt > 1000000000) {
         prin = 0;
      }

   }

	return accumInt;
}

function computeForm2(form) {
	if (window.matchMedia('(max-width: 1023px)').matches){
		jQuery('#secondary').hide();
	}

	jQuery('#principal-err-msg, #nper2-err-msg, #intRate-err-msg, #intRate2-err-msg, #payment-err-msg, #closingCost-err-msg, #yesNo-err-msg').html("");
	
	var alert_txt = "";
	var sum_cell = document.getElementById("summary");

	var pmt1 = sn(document.calc.payment.value);
	var prin = sn(document.calc.principal.value);
	var i1 = sn(document.calc.intRate.value);

	if(document.calc.principal.value == "") {
		jQuery('#principal-err-msg').html("Please enter the your mortgage's current principal balance.");
		document.calc.principal.focus();
	}
	else if(document.calc.intRate.value == "") {
		jQuery('#intRate-err-msg').html("Please enter your mortgage's current annual interest rate.");
		document.calc.intRate.focus();
	}
	else if(document.calc.payment.value == "") {
		jQuery('#payment-err-msg').html("Please enter the amount of your mortgage payment.");
		document.calc.payment.focus();
	}	
	else if(document.calc.nper2.value == "") {
		jQuery('#nper2-err-msg').html("Please enter the number of years you are refinancing for.");
		document.calc.nper2.focus();
	}
	else if(document.calc.intRate2.value == "") {
		jQuery('#intRate2-err-msg').html("Please enter the annual interest rate you'll be refinancing at.");
		document.calc.intRate2.focus();	  
	}
	else if(document.calc.closingCost.value == "") {
		jQuery('#closingCost-err-msg').html("Please enter the closing cost percentage points.");
		document.calc.closingCost.focus();
	}
	else if((prin * (i1/100/12)) > pmt1) {
		alert_txt += "The payment amount you entered ($" + fn(pmt1,2,1) + ") is too small to pay off";
		alert_txt += " your mortgage ($" + fn(prin,2,1) + ")  within an accepted time frame. Please";
		alert_txt += " increase the payment amount until you no longer receive this message.";
		jQuery('#payment-err-msg').html(alert_txt);
		document.calc.payment.focus();
	}
	
	else if(sn(document.calc.intRate2.value) > sn(document.calc.intRate.value)) {
		alert_txt = "You've entered a refinancing rate that is higher than your present rate.  ";
		alert_txt += "The refinancing rate must be lower than your present rate in ";
		alert_txt += "order for this calculator to work.";
		jQuery('#intRate2-err-msg').html(alert_txt);
	}
	else {
		var prin1 = prin;
		var closeCostAmt = 0;
		var VcloseCost = sn(document.calc.closingCost.value);
		if(document.calc.ptsDol.selectedIndex == 0) {
			var closeCostPerc = Number(VcloseCost) / 100;
			closeCostAmt = closeCostPerc * prin;
		} else {
			closeCostAmt = VcloseCost;
		}

		var i2 = sn(document.calc.intRate2.value);

		var v_orgInt = computeFixedInterestCost(prin, i1, pmt1);
		jQuery('#origInt').html("<h2>$" + fn(v_orgInt,2,1) + '</h2>');

		var prin2 = 0;

		if(document.calc.yesNo.selectedIndex == 0) {
			prin2 = prin;
		} else {
			prin2 = Number(prin) + Number(closeCostAmt);
		}

		var v_years_2 = sn(document.calc.nper2.value);
		var Vnper2 = v_years_2 * 12;

		var fpayment2 = computeMonthlyPayment(prin2, Vnper2, i2);
		fpayment2 = Math.round(fpayment2*100)/100;
		jQuery('#payment2').html("<h2>$" + fn(fpayment2,2,1) + '</h2>');


		var fmoSave = Number(pmt1) - Number(fpayment2);
		jQuery('#moSave').html("<h2>$" + fn(fmoSave,2,1) + '</h2>');

		var ftotInt2 = computeFixedInterestCost(prin2, i2, fpayment2);
		jQuery('#totInt2').html("<h2>$" + fn(ftotInt2,2,1) + '</h2>');

		var fintSave = Number(v_orgInt) - Number(ftotInt2);

		if(fintSave <= 0) {
			jQuery('#intSave').html("<h2>$0.00</h2>");
		} else {
			jQuery('#intSave').html("<h2>$" + fn(fintSave,2,1) + '</h2>');
		}

		var prin3 = prin2;
		var prin4 = prin;

		var intPort3 = 0;
		var intPort4 = 0;

		var prinPort3 = 0;
		var prinPort4 = 0;

		var accumInt3 = 0;
		var accumInt4 = 0;

		var accumPrin3 = 0;
		var accumPrin4 = 0;

		var amortIntSave = 0;

		var count3 = 0;

		while(amortIntSave < closeCostAmt) {
			intPort3 = prin3 * (i2/100/12);
			intPort4 = prin4 * (i1/100/12);

			prinPort3 = Number(fpayment2) - Number(intPort3);
			prinPort4 = Number(pmt1) - Number(intPort4);

			prin3 = Number(prin3) - Number(prinPort3);
			prin4 = Number(prin4) - Number(prinPort4);

			accumPrin3 = Number(accumPrin3) + Number(prinPort3);
			accumPrin4 = Number(accumPrin4) + Number(prinPort4);

			accumInt3 = Number(accumInt3) + Number(intPort3);
			accumInt4 = Number(accumInt4) + Number(intPort4);

			amortIntSave = Number(accumInt4) - Number(accumInt3);

			count3 = Number(count3) + Number(1);

			if(count3 > 600) {break; } else {continue; }
		}


		jQuery('#closeMo').html('<h2>' + count3 + '<h2>');

		var fnetSave = Number(fintSave) - Number(closeCostAmt);

		var pmtUpDown = "";
		if(fpayment2 > pmt1) {
			pmtUpDown = "increase by $" + fn(Number(fpayment2) - Number(pmt1),2,1) + "";
		} else {
			pmtUpDown = "decrease by $" + fn(Number(pmt1) - Number(fpayment2),2,1) + "";
		}

		var intSaveYesNo = "";
		if(v_orgInt < ftotInt2) {
			intSaveYesNo = "pay an additional $" + fn(Number(ftotInt2) - Number(v_orgInt),2,1) + " in";
			intSaveYesNo += " interest charges over the life of the mortgage.";
		} else {
			intSaveYesNo = "save $" + fn(Number(v_orgInt) - Number(ftotInt2),2,1) + " in ";
			intSaveYesNo += "interest charges over the life of the mortgage. However, in order ";
			intSaveYesNo += "for this refinancing to yield any savings at all you will need to ";
			intSaveYesNo += "stay in your current home for at least " + count3 + " months.  ";
			intSaveYesNo += "That's how long it will take for the monthly interest savings to ";
			intSaveYesNo += "offset the closing costs attributable to refinancing.";
		}

		if(fnetSave <= 0) {
			jQuery('#netSave').html("$0.00");
		} else {
			jQuery('#netSave').html("<h2>$" + fn(fnetSave,2,1) + '</h2>');
		}

		var v_summary = "If you refinance your current " + fn(i1,2,0) + "% ";
		v_summary += "mortgage to a " + fn(i2,2,0) + "% mortgage, your ";
		v_summary += "monthly payment will " + pmtUpDown + " and you will " + intSaveYesNo + "";

		jQuery('#summary').html("<font face='arial'><small>" + v_summary + "</small>");

		jQuery("#reficalc > div:first-of-type").removeAttr( 'class' );
		jQuery('#secondary').show( "slide" );
		
		if (window.matchMedia('(max-width: 1023px)').matches){
			jQuery('html, body').animate({
				scrollTop: jQuery('#secondary').offset().top -100
			}, 500);
		}
		else {
			jQuery('html, body').animate({
				scrollTop: jQuery('#masthead').offset().top
			}, 500);
		}
		
	}		
}


function clear_results2(form) {
	var sum_cell = document.getElementById("summary");
	sum_cell.innerHTML = "";

	document.calc.origInt.value = "";
	document.calc.payment2.value = "";
	document.calc.moSave.value = "";
	document.calc.totInt2.value = "";
	document.calc.intSave.value = "";
	document.calc.closeMo.value = "";
	document.calc.netSave.value = "";
}

function reset_calc2(form) {
   //if(confirm("Are you sure you want to reset the calculator to the default entries?")) {
		clear_results(document.calc);
		document.calc.reset();
		reset_position();
   //}
}

function reset_position() {
	jQuery('#secondary').hide();
	jQuery('#primary').addClass('centered');
	
	if (window.matchMedia('(max-width: 1023px)').matches){
		jQuery('html, body').animate({
			scrollTop: jQuery('#main').offset().top
		}, 500);
	}
	else {
		jQuery('html, body').animate({
			scrollTop: jQuery('#masthead').offset().top
		}, 500);
	}
}

