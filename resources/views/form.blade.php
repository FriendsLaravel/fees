<x-form @submit.prevent="submit">
    <x-modal>
        <div class="form-group">
            <x-label for="code"  > {{__('Code') }}</x-label>
            <x-input type="text"  name="code"  v-model="fields.code" required />
            <x-error v-if="errors && errors.code">@{{ errors.code[0] }}</x-error>
        </div>
        <div class="form-group">
            <x-label for="amount"  > {{__('Amount') }}</x-label>
            <x-input type="number"  name="amount"  v-model="fields.amount" required />
            <x-error v-if="errors && errors.amount">@{{ errors.amount[0] }}</x-error>
        </div>
        <div class="form-group">
            <x-label  > {{__('Position') }}</x-label>
            <x-input type="number"    v-model="fields.position" required />
            <x-error v-if="errors && errors.position">@{{ errors.position[0] }}</x-error>
        </div>
        <div class="row">
            <div class="border col-md-12 py-1 px-1" v-for="(rule, index) in fields.rules">
                <div class="form-row">
                        <div class="form-group col-md-6">
                            <x-label for="type"  > {{__('Type') }}</x-label>
                            <select  v-model="rule.type" class="form-control">
                                <option selected value="date_less_or_equal">{{ __('Date less or equal') }}</option>
                                <option value="status_equal">{{ __('Status') }}</option>
                            </select>
                        </div>
                    
                    
                        
                        <div class="form-group col-md-6" v-if="rule.type=='date_less_or_equal'">
                            <x-label> {{__('Date') }}(hour)</x-label>
                            <x-input type="number"    v-model="rule.configuration.date" required />
                        </div>
                        
                        <div class="form-group col-md-6" v-if="rule.type=='status_equal'">
                            <x-label> {{__('Status') }}</x-label>
                            <select  v-model="rule.configuration.status" class="form-control">
                                <option selected value="R">{{ __('‫‪REFUNDED‬‬') }}</option>
                                <option value="E">{{ __('EXCHANGED‬‬') }}</option>
                            </select>
                        </div>    
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a @click="deleteRule(index)" href="#" class="btn btn-danger"><i class="fa fa-trash"></i>
                            {{ __('Delete')}}
                         </a>
                    </div>
                </div>

            </div>
          
        </div>
        <a @click="addRule" href="#" class="btn btn-default mt-2"><i class="fa fa-plus"></i>
            {{ __('Add rule')}}
         </a>
        <x-slot name="footer">
            <a @click="save" class="btn btn-success float-left mx-1 float-right link-submit">{{ __('Save') }}</a>
            <button type="submit" class="btn btn-primary float-right link-submit">{{ __('save and continue') }}</button>
        </x-slot>
    </x-modal>
</x-form>