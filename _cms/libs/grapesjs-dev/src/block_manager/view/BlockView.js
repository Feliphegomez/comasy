import Backbone from 'backbone';
import { isObject } from 'underscore';
import { on, off, hasDnd } from 'utils/mixins';

module.exports = Backbone.View.extend({
  events: {
    mousedown: 'startDrag',
    dragstart: 'handleDragStart',
    drag: 'handleDrag',
    dragend: 'handleDragEnd'
  },

  initialize(o, config = {}) {
    const { model } = this;
    this.em = config.em;
    this.config = config;
    this.endDrag = this.endDrag.bind(this);
    this.ppfx = config.pStylePrefix || '';
    this.listenTo(model, 'destroy remove', this.remove);
    this.listenTo(model, 'change', this.render);
  },

  /**
   * Start block dragging
   * @private
   */
  startDrag(e) {
    const config = this.config;
    //Right or middel click
    if (e.button !== 0 || !config.getSorter || this.el.draggable) return;
    config.em.refreshCanvas();
    const sorter = config.getSorter();
    sorter.setDragHelper(this.el, e);
    sorter.setDropContent(this.model.get('content'));
    sorter.startSort(this.el);
    on(document, 'mouseup', this.endDrag);
  },

  handleDragStart(ev) {
    const { em, model } = this;
    const content = model.get('content');
    const isObj = isObject(content);
    const type = isObj ? 'text/json' : 'text';
    const data = isObj ? JSON.stringify(content) : content;

    // Note: data are not available on dragenter for security reason,
    // but will use dragContent as I need it for the Sorter context
    // IE11 supports only 'text' data type
    ev.dataTransfer.setData('text', data);
    em.set('dragContent', content);
    em.trigger('block:drag:start', model, ev);
  },

  handleDrag(ev) {
    this.em.trigger('block:drag', this.model, ev);
  },

  handleDragEnd() {
    const { em, model } = this;
    const result = em.get('dragResult');

    if (result) {
      const oldKey = 'activeOnRender';
      const oldActive = result.get && result.get(oldKey);

      if (model.get('activate') || oldActive) {
        result.trigger('active');
        result.set(oldKey, 0);
      }

      if (model.get('select')) {
        em.setSelected(result);
      }

      if (model.get('resetId')) {
        result.onAll(model => model.resetId());
      }
    }

    em.set({
      dragResult: null,
      dragContent: null
    });

    em.trigger('block:drag:stop', result, model);
  },

  /**
   * Drop block
   * @private
   */
  endDrag(e) {
    off(document, 'mouseup', this.endDrag);
    const sorter = this.config.getSorter();

    // After dropping the block in the canvas the mouseup event is not yet
    // triggerd on 'this.doc' and so clicking outside, the sorter, tries to move
    // things (throws false positives). As this method just need to drop away
    // the block helper I use the trick of 'moved = 0' to void those errors.
    sorter.moved = 0;
    sorter.endMove();
  },

  render() {
    const { em, el, ppfx, model } = this;
    const className = `${ppfx}block`;
    const label = model.get('label');
    const render = model.get('render');
    el.className += ` ${className} ${ppfx}one-bg ${ppfx}four-color-h`;
    el.innerHTML = `<div class="${className}-label">${label}</div>`;
    el.title = el.textContent.trim();
    hasDnd(em) && el.setAttribute('draggable', true);
    const result = render && render({ el, model, className, prefix: ppfx });
    if (result) el.innerHTML = result;
    return this;
  }
});
