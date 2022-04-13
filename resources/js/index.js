// WP dependencies.
import { Icon, commentReplyLink } from '@wordpress/icons';

// Internal dependencies.
import edit from './edit';
import save from './save';

// Export the block type metadata.
export { default as metadata } from '../block.json';

// Export the block type settings.
export const settings = {
        icon: <Icon icon={ commentReplyLink } />,
	edit,
	save
};
