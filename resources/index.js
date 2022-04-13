// Let webpack process stylesheets.
import './css/style.scss';
//import './css/editor.scss';

// WordPress dependencies.
import { registerBlockType } from '@wordpress/blocks';

// Import block metadata and settings.
import * as block from './js/index';

// Register block type.
registerBlockType( block.metadata, block.settings );
