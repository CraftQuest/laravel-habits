import{o as e,r as t,t as n,u as r}from"./lit-CY4PVSWl.js";import{a as i,o as a}from"./decorators-DBVcUAk8.js";import"./axios-lGwWjwFZ.js";import{n as o,t as s}from"./queue-CGBBPmz7.js";import{t as c}from"./decorate-6SDBMwo1.js";var l=class extends n{constructor(...e){super(...e),this.displayedJob=null,this.hasReservedJobs=!1,this.hasWaitingJobs=!1,this.#e=s.getInstance(),this.#t=e=>{this.displayedJob=e.detail.displayedJob}}static{this.styles=r`
    :host {
      display: contents;
    }

    :host(:not([visible])) {
      display: none;
    }

    .progress-label {
      font-size: 0.85em;
      opacity: 0.7;
    }
  `}#e;connectedCallback(){super.connectedCallback(),this.displayedJob||=this.#e.displayedJob,this.#e.addEventListener(`job-update`,this.#t),this.#r(),this.#n()}disconnectedCallback(){super.disconnectedCallback(),this.#e.removeEventListener(`job-update`,this.#t)}update(e){super.update(e),(e.has(`hasReservedJobs`)||e.has(`hasWaitingJobs`))&&this.#n(),e.has(`displayedJob`)&&this.#r()}#t;#n(){this.hasReservedJobs?this.#e.startTracking():this.hasWaitingJobs&&this.#e.runQueue()}#r(){this.displayedJob?this.setAttribute(`visible`,``):this.removeAttribute(`visible`)}get#i(){return this.displayedJob?this.displayedJob.status.value===o.Failed?100:this.displayedJob.progress??0:0}get#a(){return this.displayedJob?.status.value===o.Failed}get#o(){return this.#e.canAccessQueueManager?null:Craft.getCpUrl(`utilities/queue-manager`)}render(){return this.displayedJob?e`
      <craft-nav-item .href=${this.#o}>
        <craft-progress
          slot="prefix"
          progress=${this.#i}
          ?failed=${this.#a}
          label=${this.displayedJob.description||`Queue`}
        ></craft-progress>
        <div class="label">
          <span class="title">${this.displayedJob.description}</span>
          ${this.displayedJob.progressLabel?e`<span class="progress-label"
                >${this.displayedJob.progressLabel}</span
              >`:t}
        </div>
      </craft-nav-item>
    `:t}};c([i({type:Object,attribute:`displayed-job`})],l.prototype,`displayedJob`,void 0),c([i({type:Boolean,attribute:`has-reserved-jobs`})],l.prototype,`hasReservedJobs`,void 0),c([i({type:Boolean,attribute:`has-waiting-jobs`})],l.prototype,`hasWaitingJobs`,void 0),l=c([a(`cp-queue-indicator`)],l);var u=l;export{u as t};