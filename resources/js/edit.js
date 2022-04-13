// External dependencies.
import classnames from 'classnames';

// WordPress dependencies.
import {
	AlignmentControl,
	BlockControls,
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';

import { PanelBody, TextControl, RangeControl } from '@wordpress/components';

import { __ } from '@wordpress/i18n';

export default function Edit( {
	attributes,
	setAttributes,
} ) {
	let {
		textAlign,
		depth,
		text,
		before,
		after
	} = attributes;

	const blockProps = useBlockProps( {
		className: classnames( {
			[ `has-text-align-${ textAlign }` ]: textAlign,
		} )
	} );

	const blockControls = (
		<BlockControls group="block">
			<AlignmentControl
				value={ textAlign }
				onChange={ ( value ) =>
					setAttributes( { textAlign: value } )
				}
			/>
		</BlockControls>
	);

	const inspectorControls = (
		<InspectorControls>
			<PanelBody title={ __( 'Link settings', 'x3p0-comment-parent-link' ) }>
				<RangeControl
					label={ __( 'Depth', 'x3p0-comment-parent-link' ) }
					help={ __( 'Minimum depth in which to show the comment parent link on the front end. Always shown in the editor so it can be customized.', 'x3p0-comment-parent-link' ) }
					onChange={ ( value ) =>
						setAttributes( { depth: value } )
					}
					value={ depth }
					initialPosition={ 2 }
					allowReset={ true }
					resetFallbackValue={ 2 }
					min={ 2 }
					max={ 10 }
				/>
				<TextControl
					label={ __( 'Link Text', 'x3p0-comment-parent-link' ) }
					help={ __( "Customize link text. Use %s to show the parent comment author's name.", 'x3p0-comment-parent-link' ) }
					value={ text }
					onChange={ ( value ) =>
						setAttributes( { text: value } )
					}
				/>
				<TextControl
					label={ __( 'Before Link', 'x3p0-comment-parent-link' ) }
					help={ __( 'Add text before the link.', 'x3p0-comment-parent-link' ) }
					value={ before }
					onChange={ ( value ) =>
						setAttributes( { before: value } )
					}
				/>
				<TextControl
					label={ __( 'After Link', 'x3p0-comment-parent-link' ) }
					help={ __( 'Add text after the link.', 'x3p0-comment-parent-link' ) }
					value={ after }
					onChange={ ( value ) =>
						setAttributes( { after: value } )
					}
				/>
			</PanelBody>
		</InspectorControls>
	);

	return (
		<>
			{ blockControls }
			{ inspectorControls }
			<div { ...blockProps }>
				{ before }
				<a
					className="wp-block-x3p0-comment-parent-link__anchor"
					href="#comment-parent-pseudo-link"
					onClick={ ( event ) => event.preventDefault() }
				>
					{ attributes.text.replace(
						'%s',
						__( 'Comment Author', 'x3p0-comment-parent-link' )
					) }
				</a>
				{ after }
			</div>
		</>
	);
}
