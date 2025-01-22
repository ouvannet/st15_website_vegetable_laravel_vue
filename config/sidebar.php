<?php

return [
  'menu' => [
    [
      'text' => 'Navigation',
      'is_header' => true
    ],
    [
      'url' => '/admin/dashboard',
      'icon' => 'fa-solid fa-chart-line',
      'text' => 'Dashboard'
    ],
    [
      'icon' => 'fa fa-money-bill-alt',
      'text' => 'Sales',
      'children' => [
          [
            'url' => '/admin/sale',
            'text' => 'Sale'
          ],
          [
            'url' => '/admin/saleitems',
            'text' => 'Sale Items'
          ],
          [
            'url' => '/admin/payment',
            'text' => 'Payment'
          ],
          [
            'url' => '/admin/paymentmethod',
            'text' => 'Payment Method'
          ],
        ]
    ],
    [
      'icon' => 'fa-solid fa-store',
      'text' => 'Inventory',
      'children' => [
        [
          'url' => '/admin/products',
          'text' => 'Products'
        ],
        [
          'url' => '/admin/category',
          'text' => 'Category'
        ],
        [
          'url' => '/admin/unit',
          'text' => 'Unit'
        ],
        [
          'url' => '/admin/varient',
          'text' => 'Varient'
        ],
        [
          'url' => '/admin/brand',
          'text' => 'Brand'
        ],

      ]
    ],
    [
        'icon' => 'fa-solid fa-thumbs-up',
        'text' => 'Blogs',
        'children' => [
          [
            'url' => '/admin/blog',
            'text' => 'Blog'
          ],
          [
            'url' => '/admin/tag',
            'text' => 'Tag'
          ],
          [
            'url' => '/admin/blogcomment',
            'text' => 'Blog Comment'
          ],
        ]
    ],
    [
        'icon' => 'fa-solid fa-users',
        'text' => 'Customers',
        'children' => [
          [
            'url' => '/admin/customerfeedback',
            'text' => 'Customer Feedback'
          ],
          [
            'url' => '/admin/logoclient',
            'text' => 'Logo Client'
          ],
          [
            'url' => '/admin/cart',
            'text' => 'Cart'
          ],
          [
            'url' => '/admin/wishlist',
            'text' => 'Wishlist'
          ],
        ]
    ],
    [
      'icon' => 'fa-solid fa-user-large',
      'text' => 'People',
      'children' => [
        [
          'url' => '/admin/user',
          'text' => 'User'
        ],
        [
          'url' => '/admin/role',
          'text' => 'Role'
        ],
        [
          'url' => '/admin/permission',
          'text' => 'Permission'
        ],

      ]
    ],
    [
      'icon' => 'fa fa-chart-pie',
      'text' => 'Report',
      'children' => [
        [
          'url' => '/admin/report',
          'action' => 'Bootstrap',
          'text' => 'test 1'
        ],
        [
          'url' => '/admin/report',
          'text' => 'test 2'
        ],
        [
          'url' => '/admin/report',
          'text' => 'test 3'
        ],

      ]
    ],
    [
        'icon' => 'fa fa-cog',
        'text' => 'Site Setting',
        'children' => [
          [
            'url' => '/admin/sitesetting/site_contact',
            'text' => 'Contact'
          ]

        ]
    ],


    [
      'is_divider' => true
    ]
  ]
];
