(()=>{
    
    let getHttpRequest = () => {
        let httpRequest = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+...
            httpRequest = new XMLHttpRequest();
        }
        else if (window.ActiveXObject) { // IE 6 et antérieurs
            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }

        return httpRequest;
    }

    let httpRequest = getHttpRequest();
    let email = [];
    let id = [];
    let emailGiven = document.getElementById('email');
    let form = document.getElementById('login-form');
    let find = [];

    httpRequest.onreadystatechange = () => {
       
        if ( httpRequest.readyState === 4)
        {
            let data = httpRequest.responseText.split(';');
            for ( let i = 0; i < data.length; i++)
            {
                email.push(data[i].split(', ')[0]);
            }

        }
    }

    let error = (input, message) => {
        let parent = input.parentElement;
        let label = parent.getElementsByTagName('label')[0];
        let msg = document.createElement('div');

        input.classList.add('is-invalid');
        label.classList.add('invalid-label');
        
        msg.className="invalid";
        msg.textContent = message;
        
        if ( parent.lastElementChild.className !== "invalid"  )
        {
            parent.appendChild(msg);
        }
    }

    let removeError = (element) =>{
        let parent = element.parentElement;
        element.classList.remove('is-invalid');

        if (parent.lastElementChild.className === "invalid")
        {
            let label = parent.getElementsByTagName('label')[0];
            label.classList.remove('invalid-label');
            parent.removeChild(parent.lastElementChild);
        }
    }
    
    let check = (e) => {
       
        if (find.length > 0)
        {
            find = [];
        }

        for ( let i = 0; i < email.length; i++)
        {
            if (emailGiven.value === email[i])
            {
                find.push(i);
            }
        }

        if ( !find.length > 0)
        {
            e.preventDefault();
        }
        
    }


    emailGiven.addEventListener('change', () => {
        
        if (find.length > 0)
        {
            find = [];
        }

        for ( let i = 0; i < email.length; i++)
        {
            if (emailGiven.value === email[i])
            {
                find.push(i);
            }
        }

        if ( find.length > 0)
        {
            if (emailGiven.classList.contains('is-invalid'))
            {
                removeError(emailGiven);
            }
        }else
        {
            error(emailGiven, "Email invalide");
        }
        
    });

    form.addEventListener('submit',check);

    httpRequest.open('GET', 'http://localhost:8000/data', true);
    httpRequest.send();
})()