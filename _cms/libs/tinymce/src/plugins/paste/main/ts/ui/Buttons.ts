/**
 * Copyright (c) Tiny Technologies, Inc. All rights reserved.
 * Licensed under the LGPL or a commercial license.
 * For LGPL see License.txt in the project root for license information.
 * For commercial licenses see https://www.tiny.cloud/
 */

import { Fun } from '@ephox/katamari';
import { Editor } from 'tinymce/core/api/Editor';
import { Clipboard } from '../api/Clipboard';

const stateChange = function (editor: Editor, clipboard: Clipboard, e) {
  const ctrl = e.control;

  ctrl.active(clipboard.pasteFormat.get() === 'text');

  editor.on('PastePlainTextToggle', function (e) {
    ctrl.active(e.state);
  });
};

const register = function (editor: Editor, clipboard: Clipboard) {
  const postRender = Fun.curry(stateChange, editor, clipboard);

  editor.addButton('pastetext', {
    active: false,
    icon: 'pastetext',
    tooltip: 'Paste as text',
    cmd: 'mceTogglePlainTextPaste',
    onPostRender: postRender
  });

  editor.addMenuItem('pastetext', {
    text: 'Paste as text',
    selectable: true,
    active: clipboard.pasteFormat,
    cmd: 'mceTogglePlainTextPaste',
    onPostRender: postRender
  });
};

export default {
  register
};