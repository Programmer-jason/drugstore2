
fetch("http://localhost/drugstore-management-system/js/paymongoApi.js")
.then(response => response.json())
    .then(response => console.log(response))