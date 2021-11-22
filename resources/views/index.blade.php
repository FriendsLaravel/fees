<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-6">
                <h4 class="" title><i class="circular icon fa fa-list"></i> {{ __('Fees')  }} </h4>
            </div>
            <div class="col-6">
                <a v-on:click="create()" class="btn btn-primary btn-sm float-right" href="#"><i class="fas fa-plus-circle"></i> {{ __('Create') }}</a>
            </div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>  
    </div>
    @include('fees::form')
    <x-slot name="after_script">
        <script src="/bower_components/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

        {{$dataTable->scripts()}}
        <script>
                var app = new Vue({
                    el: '#app',
                    mixins: [ FormMixin, DestroyMixin],
                    data: {
                        action: "{{ route('fees.store') }}",
                        table: "fees-table",
                        modal: 'Idmodal',
                        count_rules: 1,
                        rules: [],
                        date_h: 0
                    },
                    mounted:function(){
                        const vm = this;
                        $(document).on('draw.dt',function(e){
                            vm.$root.load = false;
                            $("input[data-bootstrap-switch]").each(function() {
                                $(this).bootstrapSwitch('state', $(this).prop('checked'));
                                $(this).on('switchChange.bootstrapSwitch', function() {
                                    var id = $(this).data('id');
                                    axios.put("/fees/" + id,{status: true})
                                        .then(res => {
                                            vm.reload();
                                        });
                                });
                            });
                        });
                        
                    },
                    methods: {
                        create(){
                            this.action_update = '';

                            this.fields = {
                                rules: [],
                                position: 1
                            };
                            $("#"+this.modal).modal('show');
                        },
                        addRule: function(){
                            this.fields.rules.push({type:'date_less_or_equal',configuration:{}})
                        },
                        deleteRule: function(index){
                            var array = this.fields.rules;
                             array.splice(index, 1);
                             
                             this.fields.rules = array;
                        }
                    },
                })
        </script>
        
    </x-slot>
</x-app-layout>
