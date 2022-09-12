export default function admin({ next, router })
{
    if(localStorage.getItem('is_admin') == 0)
    {
        return router.push({ name: 'home' });
    }
  
    return next();
}