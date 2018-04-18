<template>
    <ul class="uk-tab" v-el:tab>
        <li><a>{{ 'Settings' | trans }}</a></li>
        <li><a>{{ 'Info' | trans }}</a></li>
    </ul>
    <div class="uk-switcher uk-margin" v-el:content>
        <div class="uk-form uk-form-horizontal">
            <h1>{{ 'Lazyload Settings' | trans }}</h1>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'HTML Class' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.class">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-effect" class="uk-form-label">{{ 'Effect' | trans }}</label>
                <div class="uk-form-controls">
                    <select id="form-effect" class="uk-form-width-medium" v-model="package.config.effect">
                        <option value="show">{{ 'Show' | trans }}</option>
                        <option value="fadeIn">{{ 'Fade' | trans }}</option>
                    </select>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-effecttime" class="uk-form-label">{{ 'Effect Duration' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="form-effecttime" class="uk-form-width-small uk-text-right" type="number"
                           name="effecttime"
                           v-model="package.config.effecttime" min="0" number>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-threshold" class="uk-form-label">{{ 'Threshold' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="form-threshold" class="uk-form-width-small uk-text-right" type="number"
                           name="threshold"
                           v-model="package.config.threshold" min="0" number>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-visibleonly" class="uk-form-label">{{ 'Visible Only' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input id="form-visibleonly" type="checkbox" v-model="package.config.visibleonly">
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-scrolldirection" class="uk-form-label">{{ 'Scroll Direction' | trans }}</label>
                <div class="uk-form-controls">
                    <select id="form-scrolldirection" class="uk-form-width-medium" v-model="package.config.scrolldirection">
                        <option value="both">{{ 'Both' | trans }}</option>
                        <option value="vertical">{{ 'Vertical' | trans }}</option>
                        <option value="horizontal">{{ 'Horizontal' | trans }}</option>
                    </select>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-combined" class="uk-form-label">{{ 'Combined' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input id="form-combined" type="checkbox" v-model="package.config.combined">
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-delay" class="uk-form-label">{{ 'Delay' | trans }}</label>
                <div class="uk-form-controls">
                    <input id="form-delay" class="uk-form-width-small uk-text-right" type="number"
                           name="delay"
                           v-model="package.config.delay" min="-1" number>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-defaultimage" class="uk-form-label">{{ 'Add Default Image' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input id="form-defaultimage" type="checkbox" v-model="package.config.defaultimage.enabled">
                </div>
            </div>
            <div class="uk-form-row" v-if="package.config.defaultimage.enabled">
                <label class="uk-form-label">{{ 'Default Image  Data URI' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <p class="uk-form-controls-condensed">
                        <input type="text" class="uk-form-width-large" v-model="package.config.defaultimage.datauri">
                    </p>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="form-enablecallback" class="uk-form-label">{{ 'Enable Callback' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <input id="form-enablecallback" type="checkbox" v-model="package.config.callback.enabled">
                </div>
            </div>
            <div class="uk-form-row" v-if="package.config.callback.enabled">
                <label class="uk-form-label">{{ 'Before Load' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <v-editor type="code" :value.sync="package.config.callback.beforeload"></v-editor>
                </div>
            </div>
            <div class="uk-form-row" v-if="package.config.callback.enabled">
                <label class="uk-form-label">{{ 'After Load' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <v-editor type="code" :value.sync="package.config.callback.afterload"></v-editor>
                </div>
            </div>
            <div class="uk-form-row" v-if="package.config.callback.enabled">
                <label class="uk-form-label">{{ 'On Error' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <v-editor type="code" :value.sync="package.config.callback.onerror"></v-editor>
                </div>
            </div>
            <div class="uk-form-row" v-if="package.config.callback.enabled">
                <label class="uk-form-label">{{ 'On Finished All' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <v-editor type="code" :value.sync="package.config.callback.onfinishedall"></v-editor>
                </div>
            </div>
            <div class="uk-form-row uk-margin-top">
                <div class="uk-form-controls">
                    <button class="uk-button uk-button-primary" @click="save">{{ 'Save' | trans }}</button>
                </div>
            </div>
        </div>
        <div class="uk-form uk-form-horizontal">
            <h1>{{ 'Lazyload Info' | trans }}</h1>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Getting help' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <div class="uk-panel uk-panel-box">
                        <p>{{ 'You have problems using this extension? Join the Pagekit community forum.' | trans }}</p>
                        <a class="uk-button uk-width-1-1 uk-button-large" href="https://pagekit-forum.org"
                           target="_blank">Pagekit Forum</a>
                    </div>
                </div>
            </div>
            <div class="uk-form-row">
                <label class="uk-form-label">{{ 'Donate' | trans }}</label>
                <div class="uk-form-controls uk-form-controls-text">
                    <div class="uk-panel uk-panel-box">
                        <p>{{ 'Do you like my extensions? They are free. Of course I would like to get a donation, so if you want to, please open the donate link. You may find three possibilities to donate: PayPal, Patreon and Coinhive.' | trans }} </p>
                        <a class="uk-button uk-button-large uk-width-1-1 uk-button-primary"
                           href="https://spqr.wtf/support-me" target="_blank">{{ 'Donate' | trans }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

module.exports = {

	settings: true,

	props: ['package'],

	ready: function () {
		this.tab = UIkit.tab (this.$els.tab, {connect: this.$els.content});
	},

	methods: {
		save: function save() {
			this.$http.post ('admin/system/settings/config', {
				name: 'spqr/lazyload',
				config: this.package.config
			}).then (function () {
				this.$notify ('Settings saved.', '');
			}).catch (function (response) {
				this.$notify (response.message, 'danger');
			}).finally (function () {
				this.$parent.close ();
			});
		}
	}
};

window.Extensions.components['lazyload-settings'] = module.exports;
</script>