using Microsoft.AspNetCore.Http;

namespace Wellcome.API
{
    public class UploadForm
    {
        public IFormFile File { get; set; }
    }
}