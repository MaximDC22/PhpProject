document.querySelector("#inputUsername").addEventListener('keyup', function () {
    

    //field value
    let username = document.querySelector('#inputUsername').value;
        //check event
    
    //check database using ajax
    const formData = new FormData();

    formData.append('username', username);

    fetch('ajax/checkRegister.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            
            if(result.body === "this username is unique"){

            let field =document.querySelector('#inputUsername');
            let label =document.querySelector('#labelUsername');
            field.setCustomValidity("");
            label.style.color = 'green';
            label.innerHTML = 'username available';   
            field.style.color="green";
            }
            else{
            let field =document.querySelector('#inputUsername');
            let label =document.querySelector('#labelUsername');
            field.setCustomValidity("Invalid field.");
            label.style.color = 'red';
            label.innerHTML = 'username taken';   
            field.style.color="red";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    //verify response
});