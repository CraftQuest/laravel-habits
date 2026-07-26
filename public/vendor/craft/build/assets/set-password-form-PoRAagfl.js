import{o as e}from"./nav-item-rzpCmjrR-CTzArtfO.js";import{o as t,r as n,t as r}from"./lit-CY4PVSWl.js";import"./vue.esm-bundler-CFvpEgQa.js";import{a as i,i as a}from"./decorators-DBVcUAk8.js";import{t as o}from"./login-form.styles-CWod-swA.js";import{t as s}from"./decorate-6SDBMwo1.js";var c=class extends r{constructor(...e){super(...e),this.action=``,this.uid=``,this.code=``,this.initialError=``,this.newUser=!1,this._busy=!1}static{this.styles=[o]}#e(){return this.newUser?e(`Choose a password`):e(`Choose a new password`)}#t(){this._busy=!0}render(){return t`
      <craft-pane>
        <form
          class="auth-form"
          method="post"
          action="${this.action}"
          accept-charset="UTF-8"
          @submit="${this.#t}"
        >
          <input type="hidden" name="uid" value="${this.uid}" />
          <input type="hidden" name="code" value="${this.code}" />

          <craft-field-group>
            <craft-input-password
              label="${this.#e()}"
              id="newPassword"
              name="newPassword"
              autocomplete="new-password"
              required
              autofocus
            ></craft-input-password>
          </craft-field-group>

          <div class="auth-form__actions">
            <craft-button
              type="submit"
              variant="accent"
              ?loading="${this._busy}"
              style="width: 100%"
            >
              ${e(`Set Password`)}
            </craft-button>
          </div>
        </form>

        ${this.initialError?t`<craft-callout class="auth-form__error" variant="danger"
              >${this.initialError}</craft-callout
            >`:n}
      </craft-pane>
    `}};s([i()],c.prototype,`action`,void 0),s([i()],c.prototype,`uid`,void 0),s([i()],c.prototype,`code`,void 0),s([i({attribute:`initial-error`})],c.prototype,`initialError`,void 0),s([i({type:Boolean,attribute:`new-user`})],c.prototype,`newUser`,void 0),s([a()],c.prototype,`_busy`,void 0),customElements.get(`craft-set-password-form`)||customElements.define(`craft-set-password-form`,c);