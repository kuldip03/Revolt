// $(document).ready(function () {    
//   alert("calc.js is linked");
//})



// 01 working method show table with table name
function show_table_with_name(table_name){
    $.ajax(
    {
        url: "show_table_with_name.php?table_name=" + table_name,        
        success: function (result)
        {
            $("#show_table").html(result);
        }
    });
}

// 02 working method show table with table name and filed names in string
function show_table_with_field_name(fields_name_str, table_name){
    
    var fields_name = fields_name_str;
    var table_name = table_name;
    //alert(fields_name+" "+table_name);
    $.ajax(
    {
        url: "show_table_with_field_name.php?fields_name=" + fields_name+"&table_name="+table_name, 
        type: 'POST',
        success: function (result)
        {
            $("#show_table").html(result);
        }
    });
}

//hero, hero2 and show_table_with_query are helping each other keep both method togather
// 03 working method show table with query and other arguments are from html file
function show_table_with_query(sql_query, file, search = "" ,page = 1, limit = 10, column_name = "Select" )
{
    $.ajax(
    {
        url: "show_table_with_query.php?sql=" + sql_query + 
        "&file=" + file+ 
        "&id=" + page+ 
        "&search=" + search+
        "&limit=" + limit+
        "&column_name=" + column_name,
        type: 'POST',
        success: function (result)
        {
            $("#show_table").html(result);
        }
    });
}
// working used for onkeyup on search box top of table 
function hero() // used for filter and search
{
    var search_str = document.getElementById('search_str').value;   
    var search_str2 = "%"+search_str+"%";
    var file_name = document.getElementById('file_name').value;
    var auto_sql = document.getElementById('new_str').value;
    
    var limit_id = document.getElementById("limit_id");
    var limit_value = limit_id.options[limit_id.selectedIndex].value;
    var limit_text = limit_id.options[limit_id.selectedIndex].text;
    
    var column_name = document.getElementById("column_name");
    var column_value = column_name.options[column_name.selectedIndex].value;
    var column_text = column_name.options[column_name.selectedIndex].text;
    
    //alert("limit value "+limit_value+" limit text "+limit_text+" column_value "+column_value+" column_text "+column_text);
    //alert("limit value "+limit_value+" limit text "+limit_text+" column_value "+column_value+" column_text "+column_text+" search_str "+search_str+" file_name "+file_name+" auto_sql "+auto_sql);   
   
    var temp_sql = auto_sql+" WHERE "+column_value+" LIKE '"+search_str2+"'";
    
    if(column_value == "Select" || column_value == "select" || column_value == "SELECT" ){
        alert("Please Select Search By for filter..!!");
    }else{
        // i is used for pagination page no
        show_table_with_query(temp_sql, file_name, search_str, 1, limit_value, column_value);
    }     
}
// working used for onkeyup on search box top of table 
function hero2() // used for limit view same as hero function except if else
{
    
    var file_name = document.getElementById('file_name').value;
    var auto_sql = document.getElementById('new_str').value;
    
    var limit_id = document.getElementById("limit_id");
    var limit_value = limit_id.options[limit_id.selectedIndex].value;
    var limit_text = limit_id.options[limit_id.selectedIndex].text;
    
    var column_name = document.getElementById("column_name");
    var column_value = column_name.options[column_name.selectedIndex].value;
    var column_text = column_name.options[column_name.selectedIndex].text;
    
    //alert("limit value "+limit_value+" limit text "+limit_text+" column_value "+column_value+" column_text "+column_text+" search_str "+search_str+" file_name "+file_name+" auto_sql "+auto_sql);   
        
    // i is used for pagination page no
    show_table_with_query(auto_sql, file_name, '', 1, limit_value);      
}

function unlink_record(id,table_name){
    var id = id;
    var table_name = table_name;

    $.ajax(
    {
        url: "unlink_record.php?id="+ id + "&table_name=" + table_name,
        type: 'POST',
        success: function (result)
        {
            // no meaning
        }
    });
    
}
// working fine to delete record
function delete_record(id,table_name)
{
    //alert("Delete record is working and id is "+id+" and Table name is "+ table_name);
    //alert(id+" / "+table_name); working this
    if (confirm("Are you sure want to delete the record..??")) {
        unlink_record(id,table_name);// means unlink Files
        var id = id;
        var table_name = table_name;
        
        $.ajax(
        {
            url: "delete_record.php?id="+ id + "&table_name=" + table_name,
            type: 'POST',
            success: function (result)
            {
                if (result == 1) {
                    alert("Record Deleted Successfully");                    
                }
                if (result == 0) {
                    alert("Record Not Deleted..?? ");
                }
            }
        });
    }        
}


//not working but link with show button press in table
function view_record(id,table_name){
    alert("View record is working and id is "+id+" and Table name is "+ table_name+" in calc.js in action");
}



// not working modification needed
function edit_record(id,table_name)
{
    alert("Edit record is working and id is "+id+" and Table name is "+ table_name);
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

//working fine
function cahnge_password_validation() 
{
    $("#msg").text("");
    var old_pass = document.getElementById("old_pass").value;
    var pass1 = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;

    //alert(old_pass+"/ "+pass1+" /"+pass2+" new ");
    
    if (pass1 === "") {
        //alert("Fill the password please!");
        $("#msg").text("Fill the password please!");
        $("#pass1").val("");
        return false;
    } else if (pass1.length < 8) {
        //alert("Password length must be atleast 8 characters");
        $("#msg").text("Password length must be atleast 8 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1.length > 15) {
        //alert("Password length must not exceed 15 characters");
        $("#msg").text("Password length must not exceed 15 characters");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else if (pass1 != pass2) {
        //alert("New password not matched with confirm passwprd. Try again");
        $("#msg").text("New password not matched with confirm passwprd. Try again");
        $("#pass1").val("");
        $("#pass2").val("");
        return false;
    } else
    {        
        $.ajax(
            {
                url: "change_password_sql.php?str1=" + old_pass + "&str2=" + pass1 + "&str3=" + pass2,                
                success: function (result)
                {                    
                    if (result == 1) {
                        //alert("Password changed succesfully"); 
                        $("#msg").html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Password changed successfully..!!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                    } 
                    if(result != 1){
                         //alert(result);
                         $("#msg").html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>"+result+"</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                         //$("#msg").text(result);
                    }
                }
            });
    }
    return false;
}
// working fine
function get_district() {    
    var state = $("#state").val();       //1
    $.ajax(
    {
        url: "user_profile_update_sql.php?str1=" + state,  
        data: {"obj": "1"},
        success: function (result)
        {
            //$("#msg").val(result);
            $("#district1").html(result);
        }
    });
}

function user_profile_update() {

    var full_name   = document.getElementById("full_name").value;      
    var gender      = document.getElementById("gender").value;
    var dob         = document.getElementById("dob").value;      
    var address     = document.getElementById("address").value;
    var state       = document.getElementById("state").value;      
    var district1   = document.getElementById("district1").value;    
    var mobile      = document.getElementById("mobile").value;
    var email       = document.getElementById("email").value;
    
    //alert(full_name+"/ "+gender+" / "+dob+"/ "+address+" /"+state+"/ "+district1+" / "+mobile+"/ "+email);

    var mobile_rule = /^\d{10}$/;       // mobile no verify rule
    
    if (mobile.match(mobile_rule)) 
    {
        $.ajax({
            url: "user_profile_update_sql.php?full_name=" + full_name +
                    "&gender=" + gender +
                    "&dob=" + dob +
                    "&address=" + address +
                    "&state=" + state +
                    "&district1=" + district1 +
                    "&mobile=" + mobile +
                    "&email=" + email,
            //url: "user_profile_update_sql.php",        
            data: {"obj": "2"},        // 1 for 1 no function in php file
            success: function (result) 
            {
                //$("#msg").text(result);
                if(result == 1){
//                    $("#msg").text("Profile updated successfully..!!");
                    $("#msg").html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Profile updated successfully..!!</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                }
                if(result == 0){
                    $("#msg").text("Profile not updated. Please try again..!!");
                }                                 
            }
     });
     
    } else {
        alert("Invalid mobile no");        
    }
    return false;
}

// this method is incomplete
function category_filter()
{
    var music   = document.getElementById("music").value;

    var category = document.getElementById("category");
    var category_value = category.options[category.selectedIndex].value;
    var category_text = category.options[category.selectedIndex].text;
    //alert(music+"  /  "+category_value);
    $.ajax(
    {
        url: "entertainment_sql.php?str1=" + category_value + 
        "&music=" + music,
        success: function (result)
        {
            $("#show").html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>"+result+"</strong><button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
            //$("#show").html(result);
        }
    });
}


//example
function multiply(a, b = 1) {
  return a * b;
}

console.log(multiply(5, 2));
// expected output: 10

console.log(multiply(5));
// expected output: 5
