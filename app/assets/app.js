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
        tag_text_result: [],
        tag_description_result: [],
        errors_show: false,
        errors_text: '',
        keyText: 'keyText',
        key_text_result: []
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
                .then(response => {
                    this.tag_text_result = response.data.tag_text;
                    this.tag_description_result = response.data.tag_description;
                    this.errors_show = false;
                })
                .catch((error) => {
                    this.errors_text = error.response.data.message;
                    this.errors_show = true;
                    console.log(error.message);
                });
        },
        analyzeKeyText: function () {
            axios.post('/api/key-text', {
                keyText: this.keyText,
            })
                .then(response => {
                    this.key_text_result = response.data.key_text;
                    this.errors_show = false;
                })
                .catch((error) => {
                    this.errors_text = error.response.data.message;
                    this.errors_show = true;
                    console.log(error.message);
                });
        }
    }
});
