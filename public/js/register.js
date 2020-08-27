(function(){
    let form = document.getElementById('register-form');
    let user_input = form.querySelectorAll('.u_input');
    let checkbox = document.getElementById('terms');
    let select = document.getElementById('services');
    

    let removeError = (input) =>{
        let parent = input.parentElement;
        input.classList.remove('is-invalid');

        if (parent.lastElementChild.className === "invalid")
        {
            let label = parent.getElementsByTagName('label')[0];
            label.classList.remove('invalid-label');
            parent.removeChild(parent.lastElementChild);
        }
    }

    let check = (input, apply, message) => {
        
        let parent = input.parentElement;

        input.classList.add('is-invalid');

        if ( apply )
        {
            let label = parent.getElementsByTagName('label')[0];
            label.classList.add('invalid-label');
        }
        
        let msg = document.createElement('div');
        msg.className="invalid";
        msg.textContent = message;
        
        if ( parent.lastElementChild.className !== "invalid"  )
        {
            parent.appendChild(msg);
        }
            
    }

    let checkall = (e) => {
        
        let pass =[];

        for ( let i = 0; i < user_input.length; i++)
        {
            if (user_input[i].type === 'password')
            {
                pass.push(user_input[i]);
            }

            if ( user_input[i].value === "")
            {
                check(user_input[i],true, "Veuillez remplir ce champs");
            }else
            {
                removeError(user_input[i]);
            }
        }

        if ( pass.length === 2)
        {
            if (pass[0].value !== pass[1].value)
            {
                check(pass[1], true,"Les mots de passes doivent être identiques");
            }
        }

        if (checkbox.checked === false )
        {
            check(checkbox, false,"Vous devez accepter les terms");

        }else
        {
            removeError(checkbox);
        }

        if (select.options[select.selectedIndex].disabled)
        {
            check(select,true, "Veuillez choisir un service");
        }else
        {
            removeError(select);
        }

        let error = form.querySelectorAll(".is-invalid");
        if (error.length !== 0)
        {
            e.preventDefault();
        }
        
    };

    form.addEventListener('submit', checkall)
    
})()