using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using Wellcome.API;
using Wellcome.Database;

namespace Wellcome.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class AccountController : ControllerBase
    {
        private readonly WellcomeContext ctx;

        public AccountController(WellcomeContext context)
        {
            ctx = context;
        }

        [HttpPost("{uuid}/register")]
        public async Task<IActionResult> Register([FromBody] AccountDto account, string uuid)
        {
            try
            {
                await new AccountService(ctx).RegisterAccount(account);
                return Ok("Account registered succesfuly");
            }
            catch (Exception ex)
            {
                return BadRequest(ex.Message);
            }
        }

        [HttpPost("{uuid}/login")]
        public async Task<AccountDto> Login([FromBody] AccountDto account, string uuid) => await new AccountService(ctx).LogIn(account);

        [HttpPut("{uuid}/picture")]
        public async Task<AccountDto> UploadImage([FromForm] UploadForm form, string uuid) => await new AccountService(ctx).UploadImage(form, uuid);
    }
}
