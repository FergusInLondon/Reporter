import Vue from 'vue'
import Document from './Document'
import Client from './Client'
import ClientAutocomplete from './ClientAutocomplete'
import Payment from './Payment'

// Components that are registered globaly.
[ Client, Document, ClientAutocomplete, Payment ].forEach(Component => {
  Vue.component(Component.name, Component)
})
