export const hasPermission = {
    created(el, binding) {
        const name = binding.value;
        let userInfo = localStorage.getItem("user_info");
        let user = JSON.parse(userInfo);
        const permissions = user.permissions.map(permission => permission.name);
        console.log(permissions);
        if(!permissions.includes(name)){
            el.style.display = 'none';
        }

    }
  };
