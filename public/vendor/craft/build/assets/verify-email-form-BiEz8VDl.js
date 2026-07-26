import{o as e}from"./nav-item-rzpCmjrR-CTzArtfO.js";import{o as t,r as n,t as r}from"./lit-CY4PVSWl.js";import"./vue.esm-bundler-CFvpEgQa.js";import{a as i,i as a}from"./decorators-DBVcUAk8.js";import{t as o}from"./login-form.styles-CWod-swA.js";import{t as s}from"./decorate-6SDBMwo1.js";var c=class extends r{constructor(...e){super(...e),this.action=``,this.uid=``,this.code=``,this.initialError=``,this._busy=!1}static{this.styles=[o]}#e(){this._busy=!0}render(){return t`
      <craft-pane>
        <form
          class="auth-form"
          method="post"
          action="${this.action}"
          accept-charset="UTF-8"
          @submit="${this.#e}"
        >
          <input type="hidden" name="uid" value="${this.uid}" />
          <input type="hidden" name="code" value="${this.code}" />

          <h2 class="auth-form__heading">${e(`Verify your email address`)}</h2>

          <div class="auth-form__actions">
            <craft-button
              type="submit"
              variant="accent"
              ?loading="${this._busy}"
              style="width: 100%"
            >
              ${e(`Verify`)}
            </craft-button>
          </div>
        </form>

        ${this.initialError?t`<craft-callout class="auth-form__error" variant="danger"
              >${this.initialError}</craft-callout
            >`:n}
      </craft-pane>
    `}};s([i()],c.prototype,`action`,void 0),s([i()],c.prototype,`uid`,void 0),s([i()],c.prototype,`code`,void 0),s([i({attribute:`initial-error`})],c.prototype,`initialError`,void 0),s([a()],c.prototype,`_busy`,void 0),customElements.get(`craft-verify-email-form`)||customElements.define(`craft-verify-email-form`,c);