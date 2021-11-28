export default function auth ({ next, store }){
    if(!localStorage.getItem('auth_token')){
        return next({
            name: 'login'
        })
    }
    return next()
}
