using Microsoft.AspNetCore.Http;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Wellcome.API.Helpers
{
    public class FileUploadHelper
    {
        public static async Task<string> UploadFile(UploadForm form)
        {
            string fileName = GenerateUniqueFilename(form.File);
            var filePath = Path.Combine(Environment.CurrentDirectory, "Images", fileName);
            using var fileStream = new FileStream(filePath, FileMode.Create);
            await form.File.CopyToAsync(fileStream);
            return filePath;
        }

        private static string GenerateUniqueFilename(IFormFile file)
        {
            var extension = Path.GetExtension(file.FileName);
            var receipt = Guid.NewGuid().ToString();
            var fileName = $"{receipt}{extension}";
            return fileName;
        }
    }
}
