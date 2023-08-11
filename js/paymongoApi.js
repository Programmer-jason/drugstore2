const options = {
  method: 'POST',
  headers: {
    accept: 'application/json',
    'Content-Type': 'application/json',
    authorization: 'Basic sk_test_VVMwkQcU9x3nYE3tYBdC4gJh'
  },
  body: JSON.stringify({
    data: {
      attributes: {
        billing: {
          address: {
            line1: 'string',
            line2: 'string',
            city: 'string',
            state: 'string',
            postal_code: 'string',
            country: 'string'
          },
          name: 'string',
          email: 'string',
          phone: 'string'
        },
        
        description: 'string',
        line_items: [
          {
            amount: 0,
            currency: 'PHP',
            description: 'string',
            images: ['string'],
            name: 'string',
            quantity: 0
          }
        ],
        payment_method_types: ['gcash'],
        reference_number: 'string',
        send_email_receipt: false,
        show_description: true,
        show_line_items: true,
        success_url: 'string',
        statement_descriptor: 'string'
      }
    }
  })
};

fetch('https://api.paymongo.com/v1/checkout_sessions', options)
  .then(response => response.json())
  .then(response => console.log(response))
  .catch(err => console.error(err));