import './styles/app.css';

import Vue from 'vue';
import axios from 'axios';

new Vue({
    el: '#app',
    data: {
        delivery_cost: 0,
        selected: 'trans_company',
        weight: 1,
        tagText: 'tagText',
        tag_text_result: 'No result yet.',
        errors_show: false,
        errors_text: ''
    },
    delimiters: ['${', '}$'],
    methods: {
        submitForm: function () {
            axios.post('/api/transport', {
                slug: this.selected,
                weight: this.weight
            })
                .then(response => {
                    this.delivery_cost = response.data.delivery_cost;
                    this.errors_show = false;
                })
                .catch((error) => {
                    this.errors_text = error.response.data.message;
                    this.errors_show = true;
                    console.log(error.message);
                });
        },
        analyzeTagText: function () {
            axios.post('/api/tag-text', {
                tagtext: this.tagText,
            })
                .then(response => (this.delivery_cost = response.data.delivery_cost))
                .catch(error => console.log(error));
        }
    }
});
