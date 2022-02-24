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

        [HttpPost("register")]
        public async Task<IActionResult> Register([FromBody] AccountDto account)
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

        [HttpPost("login")]
        public async Task<AccountDto> Login([FromBody] AccountDto account) => await new AccountService(ctx).LogIn(account);

        [HttpPut()]
        public async Task<IActionResult> UpdateAccount([FromBody] AccountDto account)
        {
            try
            {
                await new AccountService(ctx).UpdateAccount(account);
                return Ok("Account updated");
            }
            catch (Exception ex)
            {
                return BadRequest(ex.Message);
            }
        }

        [HttpPut("{uuid}/picture")]
        public async Task<FileUploadResult> UploadImage([FromForm] UploadForm form, string uuid) => await new AccountService(ctx).UploadImage(form, uuid);
    }
}
