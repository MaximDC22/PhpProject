document.querySelector("#inputUsername").addEventListener('keyup', function () {
    

    //field value
    let username = document.querySelector('#inputUsername').value;
        //check event
        console.log(username);
    //check database using ajax
    const formData = new FormData();

    formData.append('username', username);

    fetch('ajax/checkRegister.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    //verify response
});