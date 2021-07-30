<?php
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
$url .= $_SERVER['HTTP_HOST'];
$url;
?>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> <span class="text-danger">© Company Name</span>
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block text-danger">
                    <!--<div class="text-sm-end  text-danger">-->
                    Design & Develop by <a href="<?php echo $url; ?>">Company Domain</a>
                </div>
            </div>
        </div>
    </div>
</footer>