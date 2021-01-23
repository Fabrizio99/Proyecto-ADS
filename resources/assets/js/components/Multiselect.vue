<template>
    <div :class="'form-group col-md-'+ colSize">
        <label>{{ label }}</label>
        <multiselect
                v-model="$attrs.value"
                :options="options"
                :label="propertyName"
                :track-by="propertyName"
                :show-labels="false"
                selectedLabel=" "
                :multiple="true"
                :limit="limit"
                :disabled="disabled"
                :max="limit"
                :taggable="true"
                :option-height="46"
                :allow-empty="true"
                @input="sendSelectedOptions"
                :placeholder="placeholder">
            <template slot="singleLabel" slot-scope="{ option }"><strong>{{ option[propertyName] }}</strong>
            </template>
        </multiselect>
    </div>

</template>

<script>
    import {Multiselect} from 'vue-multiselect';

    export default {
        props: {
            ids : {
              type : String,
              default : ''
            },
            label: {
                type: String,
                required: true
            },
            placeholder: {
                type: String
            },
            urlService: {
                type: String
            },
            useService: {
                type: Boolean,
                default: false
            },
            colSize: {
                type: Number,
                default: 12
            },
            propertyName: {
                type: String,
                default: 'name'
            },
            limit: {
                type: Number,
                default: 1
            },
            singleValueAsObject: {
                type: Boolean,
                default: true
            },
            fieldValue:{
                type: Function,
                default: (value) => { return value['name']; }
            },
            optionList: {
                type: Array
            },
            disabled: {
              type: Boolean,
              default: false
            },
            // use it only if you wanna receive more data rather than only "name" and "id" when an option is selected
            additionalData : {
                type : Boolean,
                default : false
            },
            //only used if you wanna additional data
            parameters : {
                type : Array,
            }
        },
        components: {
            multiselect: Multiselect
        },
        data(){
            return {
                nameComponent: 'Combo General 2',
                options: []
            }
        },
        methods: {
            loadData(){
                if(this.useService === true){
                    axios.get(this.urlService)
                        .then( resp => {
                            const values = resp.data;
                            values.forEach(value => {
                                const option = {};
                                //option[this.propertyName] = value[this.propertyName];
                                option[this.propertyName] = this.fieldValue(value);

                                if(this.additionalData){
                                    this.parameters.forEach(property=>{option[property] = value[property]});
                                }

                                option.id   = value.id;
                                this.options.push(option);
                            });
                        })
                        .catch( error => {
                            console.log(error);
                        })
                } else {
                    this.optionList.forEach(value => {
                        const option = {};
                        option[this.propertyName] = this.fieldValue(value);
                        if(this.additionalData){
                            this.parameters.forEach(property=>{option[property] = value[property]});
                        }
                        option.id   = value.id;
                        this.options.push(option);
                    });
                }
            },
            sendSelectedOptions(value){
                if(value !== null){
                    if(this.singleValueAsObject){
                        if(value.length <= 1){
                            this.$emit('input', value[0]);
                        } else {
                            this.$emit('input', value);
                        }
                    } else {
                        this.$emit('input', value);
                    }
                }
            }
        },
        watch: {
            optionList(){
                this.options.length = 0;
                this.loadData();
            }
        },
        mounted(){
            this.loadData();
        }
    }

</script>
