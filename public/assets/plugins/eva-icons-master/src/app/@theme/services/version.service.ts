/**
 * @license
 * Copyright Akveo. All Rights Reserved.
 * Licensed under the MIT License. See License.txt in the project root for license information.
 */

import { Injectable } from '@angular/core';

@Injectable()
export class EvaVersionService {

  getEvoVersion() {
    return require('../../../../package.json').version;
  }
}
