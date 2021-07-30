$(document).ready(function () {
display_records_in_table('a_post');
});
function service_provider_left_service(status) {
//    alert("status: " + status);
    if (status == 'paid') {
        $.ajax({url: "service_provider_left_service.php", success: function (result) {
                $("#service_list").html(result);
            }});
    }
    if (status != 'paid') {
        $("#result").html("You are not Authorised for Adding New Services");
    }

}
function display_notification(id) {
    $.ajax({url: "display_notification.php?id=" + id, success: function (result) {
            $("#display").html(result);
        }});
}
function notification_validate() {
    var title = document.getElementById('msg_title').value;
    var msg = document.getElementById('msg1').value;
    $("#result").html(title + " : " + msg);
}
function child_agent(table, str) {
//    alert(table);
    $("#result").html(str);
    $.ajax({url: "child_agent.php?table=" + table + "&str=" + str, success: function (result) {
            $("#display").html(result);
        }});
}
function load_table(table, str) {
//    alert(table);
    $("#result").html(str);
    $.ajax({url: "search_agent.php?table=" + table + "&str=" + str, success: function (result) {
            $("#display").html(result);
        }});
}
function dashboard_row_1() {
//    alert("dddddddd");
    $.ajax({url: "dashboard_row_1.php", success: function (result) {
            $("#dashboard_row_1").html(result);
        }});
}
function set_active_inactive(str, id) 
{
    var status = null;
    if (str == true) {
        status = 'active';
    }
    if (str == false) {
        status = 'deactive';
    }
//    $("#result").html(status+" "+id);
    $.ajax({url: "set_active_inactive.php?status=" + status + "&id=" + id, success: function (result) {

            var dd = $.trim(result);
            dashboard_row_1();
            document.getElementById(id).innerHTML = result;
            if (dd == "active") {
//                $("#result").html(status + " active=: " + id + id);
//                document.getElementById(id).innerHTML = result;
                document.getElementById(id + "" + id).style.backgroundColor = "GREEN";
//                document.getElementById(id + id).style.color = "green";
//                document.getElementById('active').style.color = "green";
                document.getElementsByClassName('active').style.color = "green";
            }
            if (dd == "deactive") {
//                $("#result").html(status + " deactive=: " + id + id);
//                document.getElementById(id).innerHTML = result;
                document.getElementById(id + "" + id).style.backgroundColor = "#ed5249";
//                document.getElementById(id + id).style.color = "red";
//                document.getElementById('deactive').style.color = "red";
                document.getElementsByClassName('deactive').style.color = "red";
            }

        }});
}
function display_records_in_table(table) {
    $.ajax({url: "display_records_in_table.php?table=" + table, success: function (result) {
            $("#display").html(result);
        }});
}
function display_records_with_query(table,sql) {
    $.ajax({url: "display_records_with_query.php?table=" + table + "&sql=" + sql, success: function (result) {
            $("#display").html(result);
        }});
}
function search_str(search_string, search_col, table) {
    $.ajax({url: "search_str.php?search_str=" + search_string + "&table=" + table + "&search_col=" + search_col, success: function (result) {
            $("#display").html(result);
        }});
}
function delete_universal(id, tb) {
    $("#result").html("");
    if (confirm("Are you sure want to delete the record..??")) {
        unlink_record(id, tb);
        $.ajax({url: "delete_universal.php?id=" + id + "&tb=" + tb, success: function (result) {
                var dd = $.trim(result);
                if (dd == "1") {
                    $("#result").html("<strong style='color: green;'>Record Deleted Successfully</strong>");
                    display_records_in_table(tb);
                } else if (dd == "0") {
                    $("#result").html("<strong style='color: red;'>Error on Deleting Record</strong>");
                } else {
                    $("#result").html(result);
                }
            }});
    } else {
    }
}
function update_user() {
    var full_name = document.getElementById('full_name').value;
    var father = document.getElementById('father').value;
    var gender = document.getElementById('gender').value;
    var dob = document.getElementById('dob').value;
    var mobile = document.getElementById('mobile').value;
    var aadhar = document.getElementById('aadhar').value;
    var pan = document.getElementById('pan').value;
    var account = document.getElementById('account').value;
    var ifsc = document.getElementById('ifsc').value;
    var bank = document.getElementById('bank').value;
    var upi = document.getElementById('upi').value;
    var address = document.getElementById('address').value;
    var state = document.getElementById('state').value;
    var district = document.getElementById('district').value;
    var pin = document.getElementById('pin').value;
//    $("#result").html(full_name);
    if (full_name == "") {
        $("#result").html("<strong style='color: red; padding: 5px;'>Enter Name</strong>");
    } else if (father == "") {
        $("#result").html("<strong style='color: red;'>Enter Father's Name</strong>");
    } else if (gender == "") {
        $("#result").html("<strong style='color: red;'>Select Gender</strong>");
    } else if (dob == "") {
        $("#result").html("<strong style='color: red;'>Select Date of Birth</strong>");
    } else if (mobile == "") {
        $("#result").html("<strong style='color: red;'>Enter Mobile</strong>");
    } else if (aadhar == "") {
        $("#result").html("<strong style='color: red;'>Enter aadhar No</strong>");
    } else if (pan == "") {
        $("#result").html("<strong style='color: red;'>Enter Pan No</strong>");
    } else if (account == "") {
        $("#result").html("<strong style='color: red;'>Enter Bank Account No</strong>");
    } else if (ifsc == "") {
        $("#result").html("<strong style='color: red;'>Enter IFSC Code</strong>");
    } else if (upi == "") {
        $("#result").html("<strong style='color: red;'>Enter UPI </strong>");
    } else if (address == "") {
        $("#result").html("<strong style='color: red;'>Enter Address</strong>");
    } else if (state == "") {
        $("#result").html("<strong style='color: red;'>Select State</strong>");
    } else if (district == "") {
        $("#result").html("<strong style='color: red;'>Select District</strong>");
    } else if (pin == "") {
        $("#result").html("<strong style='color: red;'>Enter Area Pin Code</strong>");
    } else {
//        $("#result").html(full_name+" "+father);

        $.ajax({url: "user_profile_update_sql.php?str_1=" + full_name +
                    "&str_2=" + father +
                    "&str_3=" + gender +
                    "&str_4=" + dob +
                    "&str_5=" + mobile +
                    "&str_6=" + aadhar +
                    "&str_7=" + pan +
                    "&str_8=" + account +
                    "&str_9=" + ifsc +
                    "&str_10=" + upi +
                    "&str_11=" + address +
                    "&str_12=" + state +
                    "&str_13=" + district +
                    "&str_14=" + pin,
            success: function (result) {
                $("#result").html(result);
//                $("#result").html(full_name+" "+father);
                var dd = $.trim(result);
                if (dd == "1") {
                    $("#result").html("<strong style='color: blue;'>Dublicate Entry</strong>");
                } else if (dd == "2") {
                    $("#result").html("<strong style='color: green;'>Data Inserted Successfully</strong>");
                } else if (dd == "3") {
                    $("#result").html("<strong style='color: red;'>Error on Inserting Data</strong>");
                } else if (dd == "4") {
                    $("#result").html("<strong style='color: green;'>Data Updated Successfully</strong>");
                    search_str(mobile, "MOBILE", "mlm_users");
                } else if (dd == "5") {
                    $("#result").html("<strong style='color: red;'>Error on Data Updating</strong>");
                }
            }});
    }
}

//document.getElementById("profile_update").addEventListener("click", function () {
//    alert("Hello Worlddddddddddddddd!");
//});

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