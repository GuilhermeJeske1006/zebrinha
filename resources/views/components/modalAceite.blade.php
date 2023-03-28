<div id="cookiePopup">
    <h4>Este site usa cookies</h4>
    <p class="stext-104">Para garantir a melhor experiência possível, este site utiliza cookies. Ao continuar navegando, você concorda com nossa política de privacidade.</p>
    <button id="acceptCookie">Aceitar</button>
</div>
<style>
    #cookiePopup {
        background: white;
        width: 25%;
        position: fixed;
        left: 10px;
        bottom: 20px;
        box-shadow: 0px 0px 15px #cccccc;
        padding: 2rem;
    }
    #cookiePopup p{
        margin: 5px 0px 13px 0px;
    }
    #cookiePopup button{
        width: 100%;
        border: navajowhite;
        background: #717fe0;
        padding: 5px;
        border-radius: 10px;
        color: white;
    }
    @media only screen and (max-width: 600px) {
        #cookiePopup {
            width: 70%;
        }
    }
</style>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript">
        // set cookie according to you
        var cookieName= "CodingStatus";
        var cookieValue="Coding Tutorials";
        var cookieExpireDays= 30;

        // when users click accept button
        let acceptCookie= document.getElementById("acceptCookie");
        acceptCookie.onclick= function(){
            createCookie(cookieName, cookieValue, cookieExpireDays);
        }

        // function to set cookie in web browser
        let createCookie= function(cookieName, cookieValue, cookieExpireDays){
            let currentDate = new Date();
            currentDate.setTime(currentDate.getTime() + (cookieExpireDays*24*60*60*1000));
            let expires = "expires=" + currentDate.toGMTString();
            document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
            if(document.cookie){
                document.getElementById("cookiePopup").style.display = "none";
            }else{
                alert("Unable to set cookie. Please allow all cookies site from cookie setting of your browser");
            }

        }

        // get cookie from the web browser
        let getCookie= function(cookieName){
            let name = cookieName + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        // check cookie is set or not
        let checkCookie= function(){
            let check=getCookie(cookieName);
            if(check==""){
                document.getElementById("cookiePopup").style.display = "block";
            }else{

                document.getElementById("cookiePopup").style.display = "none";
            }
        }
        checkCookie();
    </script>


