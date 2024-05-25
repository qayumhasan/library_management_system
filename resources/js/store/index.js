import { createStore } from 'vuex'
import author from './author'
import books from './books'
import members from './members'
import borrowed from './borrowed'
import auth from './auth'
import role from './role'
import user from './user'

const store = createStore({
    modules:{
        author,
        books,
        members,
        borrowed,
        auth,
        role,
        user
    }
})

export default store
