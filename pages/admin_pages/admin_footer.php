
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../../js/jsAnimation.js"></script>
    <script>
        
        //notification
        function loadDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                }
            };
            xhttp.open("GET", "./notify.php", true);
            xhttp.send();

            document.querySelector(".notifCount").style.display = "none"
        }

        // IN STORE PURCHASE
        async function inStorePurchase(prodId) {
            let myObject = await fetch('./inStorePurchase.php?prodId=' + prodId);
            let myText = await myObject.text();
            document.querySelector('.instore-purchase2').innerHTML = myText
        }

        // AddStockAndDamage.php
        async function addStockAndDamage(stockId) {
            let myObject = await fetch('./addStockAndDamage.php?stockId=' + stockId);
            let myText = await myObject.text();
            document.querySelector('.insert-form').innerHTML = myText
        }

        async function addDamage(stockId, stockType) {
            let myObject = await fetch('./addStockAndDamage.php?stockId=' + stockId + '&ST=' + stockType);
            let myText = await myObject.text();
            document.querySelector('.insert-form').innerHTML = myText
        }
       
    </script>
</body>
</html>